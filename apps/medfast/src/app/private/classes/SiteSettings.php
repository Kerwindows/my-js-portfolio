<?php class SiteSettings
{
    private static $siteSettingsArray = [];
    public static $setEndYear;
    public static $setForm6EndYear;
    public static $setClass;
    public static $setForm;
    public static $setPublicID = null;

    public static function init()
    {
        $db = new dbase;
        $db->query("SELECT * FROM settings");
        $fetch = $db->fetchMultiple();
        foreach ($fetch as $row) {
            self::$siteSettingsArray[$row['site_key']] = $row['site_value'];
        }
        // Note: Assuming dbase class handles connection closure, if not, you might need to explicitly close it.
    }

    public static function getSiteTitle()
    {
        return self::$siteSettingsArray['Site Title'] ?? 'Default Title';
    }

    public static function getSiteLogo()
    {
        return self::$siteSettingsArray['Site Logo'] ?? 'Default Logo Path';
    }

    public static function getTimeZone()
    {
        return self::$siteSettingsArray['Time Zone'] ?? 'Default Time Zone';
    }

    public static function getEmailNotifications()
    {
        return self::$siteSettingsArray['Send Email Notifications'] ?? 'Default Email Notification Setting';
    }

    public static function getSiteUrl()
    {
        return self::$siteSettingsArray['Site Url'] ?? 'Default URL';
    }
}