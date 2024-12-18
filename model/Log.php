
<?php
require_once('ModelBase.php');


class Log
{
    private string $user;
    private int $userid;
    private string $date;
    private int $direction;

    public static function createLog($direction,$userid) {
        try{
            $conn = connect();
            $sql = 'CALL`createLog`('.$direction.','.$userid.')'; 
            mysql_query($conn,$sql);
            
        }catch{

        }
    }






    public function __construct(string $user, int $userid, string $date, int $direction)
    {
        $this->user = $user;
        $this->userid = $userid;
        $this->date = date('Y-m-d H:i:s');
        $this->direction = $direction;
    }

    // Getter és Setter a $datum mezőhöz
    public function getDatum(): string
    {
        return $this->date;
    }

    public function setDatum(string $date): void
    {
        $this->date = $date;
    }

    // Getter és Setter a $user mezőhöz
    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }
    public function log()
    {
        $content = '<log>
            <datum>' . $this->date . '</datum>
            <user>' . $this->user . '</user>
            <direction>' . $this->direction . '</direction>
        </log>';

        $eddigiLogok = file_get_contents('log.xml');
        $ujLog = $eddigiLogok . $content;
        file_put_contents('log.xml', $ujLog);
    }


}




?>