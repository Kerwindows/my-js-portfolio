<?php
class ComponentRenderer
{
    private $data;
    private $functionName;
    private $filePath;

    // Constructor accepts an associative array with all required data
    public function __construct($data = [], $functionName, $filePath)
    {
        $this->data = $data;
        $this->functionName = $functionName;
        $this->filePath = $filePath;
    }

    public function render()
    {
        $keyvalues = $this->data;

        // Include the file where the function is defined
        require_once($this->filePath);

        // Check if the function is callable before calling it
        if (is_callable($this->functionName)) {
            // Call the function with $keyvalues
            call_user_func($this->functionName, $keyvalues);
        } else {
            // Handle the case where the function is not callable
            echo "Error: The function '{$this->functionName}' is not callable or does not exist.";
        }
    }
}

class DynamicActiveBox {
    private $data;

    // Constructor accepts an associative array with 'current_user_info' and 'role'
    public function __construct($data) {
        $this->data = $data;
    }

    public function render() {
        // Include the file that contains the functions for the active boxes
        require_once(PRIVATE_COMPONENTS_PATH . '/infoboxes/userActiveBox.php');

        // Dynamically determine the function name based on the role
        $functionName = $this->data['role'] . 'ActiveBox';

        // Check if the function exists and is callable
        if (is_callable($functionName)) {
            // Call the function, passing it the same array with 'current_user_info'
            call_user_func($functionName, $this->data);
        } else {
            // Handle the case where the function doesn't exist
            echo "Error: The function {$functionName} does not exist.";
        }
    }
}