<?php
class DBUtil
{
    // Validation and insertion, without handling transactions directly
    public static function validateAndInsert(dbase $db, $table, array $data, array $rules)
    {
        $validationResult = self::validate($data, $rules);
        $errors = $validationResult['errors'];
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        // Use the sanitized and validated data for insertion
        $data = $validationResult['data'];

        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $query = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
            $db->query($query); // Assuming $db is a PDO instance or similar

            foreach ($data as $param => $value) {
                // Bind using the sanitized and validated data
                $type = PDO::PARAM_STR; // You might want to adjust types based on actual data types
                $db->bind(':' . $param, $value, $type);
            }

            $db->execute();
            return ['success' => true, 'lastInsertId' => $db->lastInsertId()];
        } catch (PDOException $pdoe) {
    // Check for a duplicate entry error code, 1062 for MySQL
    if ($pdoe->getCode() == 23000) {
        // Customize the message for a unique constraint violation
        $customMessage = "This email address is already registered.";
        return ['success' => false, 'errors' => ['email' => [$customMessage]]];
    } else {
        // For all other SQL errors, return the original error message
        return ['success' => false, 'errors' => $pdoe->getMessage()];
    }
}
    }



private static function validate(array $data, array $rules) {
    $errors = [];
    $sanitizedData = [];

    foreach ($rules as $param => $rule) {
        $value = $data[$param] ?? null; // Use null coalescing operator
        $isOptional = $rule['optional'] ?? false;

        // Check if the field is required but missing or empty (consider '0' as a non-empty value)
        if (!$isOptional && ($value === null || (trim($value) === '' && $value !== '0'))) {
            $errors[$param][] = $rule['errorMessage'] ?? "$param is required.";
            continue;
        }

        // Skip further validation for optional fields that are empty and not '0'
        if ($isOptional && $value === null) {
            continue;
        }

        // Initialize validated value with the original input
        $validatedValue = $value;

        // Perform validation based on the type defined in rules
        switch ($rule['type'] ?? 'string') {
            case 'int':
                $validatedValue = filter_var($value, FILTER_VALIDATE_INT);
                if ($validatedValue === false && $value !== '0') {
                    $errors[$param][] = $rule['errorMessage'] ?? "$param is not a valid integer.";
                } else {
                    $sanitizedData[$param] = $validatedValue;  // Store the integer value if validation passes
                }
                break;
            case 'string':
                $sanitizedData[$param] = filter_var($value, FILTER_SANITIZE_STRING);
                break;
            case 'date':
                $date = DateTime::createFromFormat('Y-m-d', $value);
                if (!$date || $date->format('Y-m-d') !== $value) {
                    $errors[$param][] = $rule['errorMessage'] ?? "$param is not a valid date.";
                } else {
                    $sanitizedData[$param] = $value;  // Store the valid date
                }
                break;
        }

        // Additional validations for regex, minLength, and maxLength
        if (isset($rule['regex']) && !preg_match($rule['regex'], $value)) {
            $errors[$param][] = $rule['errorMessage'] ?? "$param does not match the required pattern.";
        }
        if (isset($rule['minLength']) && strlen($value) < $rule['minLength']) {
            $errors[$param][] = $rule['errorMessage'] ?? "$param is shorter than the minimum allowed length.";
        }
        if (isset($rule['maxLength']) && strlen($value) > $rule['maxLength']) {
            $errors[$param][] = $rule['errorMessage'] ?? "$param is longer than the maximum allowed length.";
        }

        // Only store in sanitizedData if there are no errors for this field
        if (empty($errors[$param])) {
            $sanitizedData[$param] = $validatedValue;
        }
    }

    return ['errors' => $errors, 'data' => $sanitizedData];
}

    
    
public static function validateAndUpdate(dbase $db, $table, array $data, array $rules, array $whereClause)
{
    $validationResult = self::validate($data, $rules);
    $errors = $validationResult['errors'];
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    $data = $validationResult['data'];
    $setParts = [];
    foreach ($data as $param => $value) {
        // Explicitly include all parameters in the update set, regardless of their value
        $setParts[] = "{$param} = :{$param}";
    }
    
    if (empty($setParts)) {
        // If no data to update, you could handle this case specifically
        return ['success' => true, 'message' => 'No changes made.'];
    }

    $setString = implode(', ', $setParts);
    $whereParts = [];
    foreach ($whereClause as $key => $value) {
        $whereParts[] = "{$key} = :where_{$key}";
    }
    $whereString = implode(' AND ', $whereParts);

    $query = "UPDATE {$table} SET {$setString} WHERE {$whereString}";
    $db->query($query);

    foreach ($data as $param => $value) {
        // Assume string type for simplicity; this should be adjusted based on actual data types
        $db->bind(':' . $param, $value, PDO::PARAM_STR);
    }

    foreach ($whereClause as $key => $value) {
        $db->bind(':where_' . $key, $value, PDO::PARAM_STR); // Adjust the type as necessary
    }

    $db->execute();
    return ['success' => true];
}


}