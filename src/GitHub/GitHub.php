<?php
namespace GitHub;

class GitHub
{
    private static $username;
    private static $project;
	private static $branch = 'master';
    public function hello()
    {
        return 'Hello. My Name is github-sh' . PHP_EOL
            .'I born to help you with LE-ZE-RA to access the browser.' . PHP_EOL
            .'If its our first meet, in doubt, please ask me for help.' . PHP_EOL
            .'Ops, I almost forgot to introduce myself.' . PHP_EOL
            .'The unoccupied person behind me are:' . PHP_EOL
            .'    Henrique Moody <henriquemoody@gmail.com> (creator)' . PHP_EOL
            .'    Ivo nascimento <iannsp@gmail.com> (the helper).' . PHP_EOL
            .'Having Fun!!' . PHP_EOL . PHP_EOL;

    }
    public function goodbye()
    {
        require __DIR__ . '/randomthought.php';
        $rid = array_rand($thought,1);
        return "Good By.\nand never forgot:\t'{$thought[$rid]}'.\n\n";
    }
    public function isValid(\StdClass $cmd)
    {
        $whatcan = array(
        'hello'=> array('class'=>'GitHub\GitHub', 'method'=>'hello')
        ,'goodbye'=> array('class'=>'GitHub\GitHub', 'method'=>'goodbye')
        ,'tchau'=> array('class'=>'GitHub\GitHub', 'method'=>'goodbye')
        ,'exit'=> array('class'=>'GitHub\GitHub', 'method'=>'goodbye')
        ,'set'=> array('class'=>'GitHub\GitHub', 'method'=>'set')
        ,'get'=> array('class'=>'GitHub\GitHub', 'method'=>'get')
        ,'issue'=> array('class'=>'GitHub\Command\Issue', 'method'=>'__get')
        );
        $cmd->isValid = array_key_exists($cmd->command, $whatcan);
        if ($cmd->isValid) {
            $cmd->execution = new \StdClass;
            $cmd->execution->class = $whatcan[$cmd->command]['class'];
            $cmd->execution->method= $whatcan[$cmd->command]['method'];
        }

        return $cmd;
    }

    public function set($property, $value)
    {
        if (in_array($property, array('username','project','branch'))) {
            self::$$property = $value;
            return $value;
        }

        return "property {$property} not valid";
    }
    public function get($property)
    {
        if(!property_exists($this, $property))
        {
            return "property github.{$property} don't exist.";
        }
        return self::$$property;
    }

}