<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - getSiteTitle()	--- get site title
 * - getSiteLogo()	--- get site logo image
 * - getTimeZone()	--- get system time zone
 * - getForm6Option()	--- get school form 6 option
 * - getFirstTermYear() --- get school year from database ---
 * - getFormNumber()	--- get form number given the setEndYear property ---
 * - getClass()		--- print student setclass from setclass property eg. A ---
 * - getForm()		--- get form from FormNumber given the setEndYear eg. "Form5" ---
 * - getFormClass()	--- get form class from FormNumber and setclass property eg. Form5-A ---
 * - getFormRoom()	--- get form room from FormNumber and setclass property eg. 5A ---
 * - getEndYear()	--- get student OLevel exam year given the setForm property and the school first term from the database       
 * - getForm6Room()	--- 
 * - getForm6()
 * - get6EndYear()	--- get student end year from setForm property eg. 2022 ---
 * - getForm6Number()
 * - getEmailNotifications()
 * Classes list:
 * - SiteSettings
 */
class SiteSettings
{

  public $setEndYear;
  public $setForm6EndYear;
  public $setClass;
  public $setForm;
  public $setPublicID = Null;

  public function __construct()
  {
    $array = [];
    $db = new dbase;
    $db->query("SELECT * FROM settings");
    $fetch = $db->fetchMultiple();
    foreach ($fetch as $row)
    {
      $array[$row['site_key']] = $row['site_value'];
    }
    $this->site_settings_array = $array;
    $db = Null;
   } 

  
  public function getSiteTitle()
  {
   return $this->site_settings_array['Site Title'];
  } 
  public function getSiteLogo()
  {
   return $this->site_settings_array['Site Logo'];
  }
  public function getTimeZone()
  {
   return $this->site_settings_array['Time Zone'];
  }
  public function getForm6Option()
  {
   return $this->site_settings_array['Form6 Option'];
  }
  public function getFirstTermYear()
  {
    return $this->site_settings_array['School Year'];
  }
  public function getEmailNotifications()
  {
    return $this->site_settings_array['Send Email Notifications'];
  }
  public function getSiteUrl()
  {
    return $this->site_settings_array['Site Url'];
  }
  public function getFormNumber()
  {
    if (empty($this->setEndYear))
    {
      $this->output = "";
    }

    elseif (($this->setEndYear - $this->site_settings_array['School Year']) == 1)
    {
      $this->output = "5";
    }
    elseif (($this->setEndYear - $this->site_settings_array['School Year']) == 2)
    {
      $this->output = "4";
    }
    elseif (($this->setEndYear - $this->site_settings_array['School Year']) == 3)
    {
      $this->output = "3";
    }
    elseif (($this->setEndYear - $this->site_settings_array['School Year']) == 4)
    {
      $this->output = "2";
    }

    elseif (($this->setEndYear - $this->site_settings_array['School Year']) == 5)
    {
      $this->output = "1";
    }
    elseif (($this->setEndYear - $this->site_settings_array['School Year']) == 0)
    {
      $this->output = "Just Graduated ";
    }
    elseif (($this->setEndYear > $this->site_settings_array['School Year']))
    {
      $this->output = "Early Enrollment ";
    }
    else
    {
      $this->output = "Alumni ";
    }
    return $this->output;
    $this->formOutput = "Form" . $this->output;

  }

  public function getClass()
  {
    return $this->setClass;
  }

  public function getForm()
  {

    return "Form" . $this->getFormNumber();
  }

  public function getFormClass()
  {

    return "Form" . $this->getFormNumber() . "-" . $this->setClass;
  }

  public function getFormRoom()
  {

    return $this->getFormNumber() . $this->setClass;
  }

  public function getEndYear()
  {

    if ($this->setForm == 'Form5')
    {
      return $this->site_settings_array['School Year'] + 1;
    }
    elseif ($this->setForm == 'Form4')
    {
      return $this->site_settings_array['School Year'] + 2;
    }
    elseif ($this->setForm == 'Form3')
    {
      return $this->site_settings_array['School Year'] + 3;
    }
    elseif ($this->setForm == 'Form2')
    {
      return $this->site_settings_array['School Year'] + 4;
    }
    elseif ($this->setForm == 'Form1')
    {
      return $this->site_settings_array['School Year'] + 5;
    }

  }
 
  public function getForm6Room()
  {

    return $this->getForm6Number() . $this->setClass;
  }
  public function getForm6()
  {

    return "Form" . $this->getForm6Number();
  }
  public function get6EndYear()
  {

    if ($this->setForm == 'Form6U')
    {
      return $this->site_settings_array['School Year'] + 1;
    }
    elseif ($this->setForm == 'Form6L')
    {
      return $this->site_settings_array['School Year'] + 2;
    }
  }

  public function getForm6Number()
  {
    

    if (($this->setForm6EndYear - $this->site_settings_array['School Year']) == 1)
    {
      $this->output = "U6";
    }
    elseif (($this->setForm6EndYear - $this->site_settings_array['School Year']) == 2)
    {
      $this->output = "L6";
    }
    elseif (($this->setForm6EndYear - $this->site_settings_array['School Year']) == 3)
    {
      $this->output = "5";
    }
    elseif (($this->setForm6EndYear - $this->site_settings_array['School Year']) == 4)
    {
      $this->output = "4";
    }
    elseif (($this->setForm6EndYear - $this->site_settings_array['School Year']) == 5)
    {
      $this->output = "3";
    }
    elseif (($this->setForm6EndYear - $this->site_settings_array['School Year']) == 6)
    {
      $this->output = "2";
    }
    elseif (($this->setForm6EndYear - $this->site_settings_array['School Year']) == 7)
    {
      $this->output = "1";
    }
    elseif (($this->setForm6EndYear - $this->site_settings_array['School Year']) == 0)
    {
      $this->output = "Just Graduated ";
    }
    elseif (($this->setForm6EndYear > $this->site_settings_array['School Year']))
    {
      $this->output = "Early Enrollment ";
    }
    else
    {
      $this->output = "Alumni ";
    }
    return $this->output;
    $this->formOutput = "Form" . $this->output;

  }
  
  
  

}