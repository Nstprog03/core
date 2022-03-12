    
<?php 
date_default_timezone_set('Asia/Kolkata');
class Adapter{
    private $config = null;
    private $connect = NULL;
    public function __construct()
    {
        $this->setConfig(Ccc::getConfig('connection'));
    }

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function connect()
    {
        $connect = mysqli_connect($this->config['host'],$this->config['userName'],$this->config['password'],$this->config['dbName']);
        $this->setConnect($connect);
        return $connect;
    }

    public function setConnect($connect)
    {
        $this->connect = $connect;
        return $this;
    }

    public function getConnect()     
    {
        return $this->connect;
    }


    public function query($query)
    {
        if(!$this->getConnect()){
            $this->connect();
        }
        $result = $this->getConnect()->query($query);
        return $result;
 
    }

    public function insert($query)
    {

        $result = $this->query($query);
        if($result){
            return $this->getConnect()->insert_id;
        }
        return $result;
    }

    public function update($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function delete($query)
    {
        $result = $this->query($query);
        return $result;
    }


    public function fetchRow($query)
    {
        $result = $this->query($query);
        if($result->num_rows){
            return $result->fetch_assoc();
        }
        return false;
    }

     public function fetchAll($query,$mode=MYSQLI_ASSOC)
    {
        $result = $this->query($query);
        if($result->num_rows){
            return $result->fetch_all($mode);
        }
        return false;
    }
     public function fetchAssos($query)
    {
        $result = $this->query($query);
        if($result->num_rows){
            return $result->fetch_assoc();
        }
        return false;
    }
     public function fetchPair($query)
    {
        
        $result = $this->fetchAll($query,MYSQLI_NUM);
        if(!$result){
            return false;
        }
        $keys = array_column($result, '0');
        $values = array_column($result, '1');
        if (!$values)   {
            $values = array_fill(0,count($keys),NULL);
        }
        $result = array_combine($keys, $values);
        return $result;
    }


    public function fetchOne($query)
    {
        $result = $this->fetchAll($query,MYSQLI_NUM);
        if(!$result)
        {
            return false;
        }
        $key = $result['0']['0'];
        return $key;
    }
    
   
}
$adapter=new Adapter();
?>