<?php
class ErrorLog {
    public static string $logFileName = "log.txt";
    
    private string $date;
    private string $message;
    private array $details;
    
    public function __construct(string $date, string $message) {
        $this->date = $date;
        $this->message = $message;
        $this->details = []; //$this->details = array();
    }
    
    // Getters
    public function getDate(): string {
        return $this->date;
    }
    
    public function getMessage(): string {
        return $this->message;
    }
    
    public function getDetails(): array {
        return $this->details;
    }
    
    // Setters
    public function addDetail(string $info): void {
        $this->details[] = $info;
    }

    public function log(): bool{
        $error = $this->date . ': ' . $this->message . '
';
        for($i = 0; $i < count($this->details); $i++){
            $error .= $this->details[$i] . '
';
        }
        $error .= '
';
        try{
            $content = file_get_contents(ErrorLog::$logFileName);
            $content .= $error; //$content = $content . $error;
            file_put_contents(ErrorLog::$logFileName, $content);
            return true;
        }
        catch(Exception $ex){
            print $ex->getMessage();
            return false;
        }
    }

}



?>