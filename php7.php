<?php

# 1. NULLSafe Operator
class User {
    public function getProfile() {
        return null;
        return new Profile;
    }
}

class Profile{
    public function getTitle() {
        return null;
        return "Software Engineer";
    }
}

$user = new User;
$profile = $user->getProfile();

/*
if ($profile) {
    if($profile->getTitle()) {
        echo $profile->getTitle();
    }else{
        echo 'Not provided';
    }
}
*/
echo ($profile ? ($profile->getTitle() ?? 'Not provided') : 'Not provided'); 

# 2. Constructor Property Promotion
class Signup {
    protected UserInfo $user;

    protected PLanInfo $plan;

    public function __construct(UserInfo $user, PlanInfo $plan) {
        $this->user = $user;
        $this->plan = $plan;
    }
}

class UserInfo {
    protected string $username;

    public function __construct($username) {
        $this->username = $username;
    }
}

class PlanInfo {
    protected string $name;

    public function __construct($name = 'yearly') {
        $this->name = $name;
    }
}

$userInfo = new UserInfo('Test Account');
$planInfo = new PlanInfo('monthly');

$signup = new Signup($userInfo, $planInfo);

echo '<pre>';
print_r($signup);
echo '</pre>';
echo '<br>';

# 3. Match Expressions
class Send{}
$message = new Send();

$test = 'Send';

switch (get_class($message)) {
    case 'Send':
        $type = 'send_message';
        break;
    case 'Remove':
        $type = 'remove_message';
        break;
}
echo $type;
echo '<br>';

# 4. $object::class
// Error, cannot use ::class with dynamic class name

# 5. Named Parameters
class Invoice {
    private $customer;
    private $amount;
    private $date;

    public function __construct($customer, $amount, $date) {
        $this->customer = $customer;
        $this->amount = $amount;
        $this->date = $date;
    }
}

$invoice = new Invoice(
    'Test Account', 
    100, 
    new DateTime
);

echo '<pre>';
print_r($invoice);
echo '</pre>';
echo '<br>';

# 6. String Helpers
$string = 'inv_1234_mid_67890_rec';
echo 'Starts with inv_: '.(substr_compare($string, 'inv_', 0, strLen('_inc')) === 0 ? "Yes" : "No");
echo '<br>';
echo 'Ends with _rec: '.(substr_compare($string, '_rec', -strLen('_rec')) === 0 ? "Yes" : "No");
echo '<br>';
echo 'Contains _mid_: '.(strpos($string, '_mid_') ? "Yes" : "No");
echo '<br>';

# 6. Union and Pseudo Types
class Foo {

    public function bar(?Foo $foo) {
        echo 'Complete';
    }
}

$one = new Foo;
$two = new Foo;

$two->bar($one);
echo '<br>';
$two->bar(null);