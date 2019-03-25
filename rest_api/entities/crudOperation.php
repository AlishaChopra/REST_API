<?php
class crudOperation{
	private $connection;

    // table name
    private $table = 'emp';

    // table columns
    public $emp_id;
    public $ename;
    public $designation;
    public $salary; 

    public function __construct($connection){
        $this->connection = $connection;
    }
    //R
    public function read()
    {
        $query1='select 
        ename, designation, salary 
        from '.$this->table.'';
        $result = $this->connection->query($query1);
        //echo $result;
        return $result;
    }
        
    public function readWhere()
    {
        $query1='select 
        ename, designation, salary 
        from '.$this->table.' 
        where emp_id = ?';   
        $result=$this->connection->prepare($query1);
        $result->bind_param("i", $this->emp_id);
        $result->execute();
        $r1=$result->get_result();
        $r = $r1->fetch_assoc();
        $this->ename=$r['ename'];
        $this->designation=$r['designation'];
        $this->salary=$r['salary'];           
    }
    public function createQuery(){
        $query='insert into '.$this->table.' (ename, designation, salary)
        values (?,?,?)';
        echo $query;
        if ($result=$this->connection->prepare($query)) {
            $this->ename= htmlspecialchars(strip_tags($this->ename));
            echo $this->ename;
            $this->designation= htmlspecialchars(strip_tags($this->designation));
            echo $this->designation;
            $this->salary= htmlspecialchars(strip_tags($this->salary));
            echo $this->salary;
            $result->bind_param('ssi', $this->ename, $this->designation, $this->salary);
           // $result->bind_param('ssi', 'aa', 'bb', 80);
            if($result->execute())
            {
                return true;
            }
            printf("Error:%s.\n",$result->error);
            return false;
        }
        else {
            printf("qqqqq:");
        }
        
    }
    public function update(){
        $query='update '.$this->table.' 
        set ename=?, designation=?, salary=? 
        where emp_id=?';
        echo $query;
        if ($result=$this->connection->prepare($query)) {
            
            echo $this->emp_id;
            $this->ename= htmlspecialchars(strip_tags($this->ename));
            $this->designation= htmlspecialchars(strip_tags($this->designation));
            $this->salary= htmlspecialchars(strip_tags($this->salary));
            $this->emp_id= htmlspecialchars(strip_tags($this->emp_id));
            $result->bind_param('ssii', $this->ename, $this->designation, $this->salary,$this->emp_id);
           // $result->bind_param('ssi', 'aa', 'bb', 80);
            if($result->execute())
            {
                return true;
            }
            printf("Error:%s.\n",$result->error);
            return false;
        }
        else {
            printf("qqqqq:");
        }
    }
    public function deleteEmp(){
        $query='delete from '.$this->table.'  
        where emp_id=?';
        echo $query;
        if ($result=$this->connection->prepare($query)) {
            $this->emp_id= htmlspecialchars(strip_tags($this->emp_id));
            $result->bind_param('i', $this->emp_id);
            if($result->execute())
            {
                return true;
            }
            printf("Error:%s.\n",$result->error);
            return false;
        }
        else {
            printf("qqqqq:");
        }
    }
}
?>