<?php

class User
{

    public $username;
    protected $age; // Can be accessed by all extended classes
    public $role = 'member';

    // Constructor
    public function __construct($username, $age)
    {
        $this->username = $username;
        $this->age = $age;
    }

    public function __destruct()
    {
        //Called after code exits
        return "$this->username was destroyed.";
    }

    public function __clone()
    {
        $this->username = $this->username . '(clone)';
    }

    public function addFriend()
    {
        return "$this->username is $this->age years old";
    }
    // Getters
    public function getUsername()
    {
        return $this->username;
    }

    //Setters
    public function setUsername($username = null)
    {
        if (isset($username)) {
            $this->username = $username;
            echo 'Done';
        } else {
            return 'Field cannot be empty';
        }
    }

    public function sendEmail()
    {
        return "$this->age, a member, has sent you a message." . '<br>';
    }
}

// Object user instance
$user1 = new User('Fire', 56);
$user2 = new User('Ice', 2000);

// echo $user->username . '<br>';
// echo $user->age . '<br>';
// echo $user->addFriend() . '<br>';

echo $user2->getUsername() . '<br>';
echo $user2->setUsername() . '<br>';
echo $user2->setUsername('Home') . '<br>';
echo $user2->getUsername() . ' is the new username!<br><br>';

// Some methods
// print_r(get_class_vars('User'));
// print_r(get_class_methods('User'));

class AdminUser extends User
{
    public $accessLevel;
    public $role = 'admin';

    public function __construct($username, $age, $accessLevel)
    {
        $this->accessLevel = $accessLevel;
        parent::__construct($username, $age);
        // parent::getUsername();
    }
    // Funcrion override
    public function sendEmail()
    {
        return "$this->age, an admin, has sent you a message." . '<br>';
    }
}

// Admin user instance
$user3 = new AdminUser('Admin', 34, 5);

echo $user3->getUsername() . '<br>';
echo $user3->accessLevel . '<br>';
echo $user3->role . '<br>';

echo $user2->sendEmail();
echo $user3->sendEmail();

class Weather
{
    private static $weathers = ['Spring', 'Summer', 'Winter'];

    public static function getTemperature()
    {
        return 'Its shit hot';
    }

    public static function determineWeatherCondition($f)
    {
        if ($f < 40) {
            // return $this->weathers[1]; // $this wont work because its static (not instantiated)
            // Instead use self
            return self::$weathers[2];
        } else if ($f >= 40) {
            return self::$weathers[1];
        }
    }
}

// access static property
//print_r(Weather::$weathers);
echo Weather::getTemperature();

echo (Weather::determineWeatherCondition(55));


// echo $_SERVER['SERVER_PORT'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>