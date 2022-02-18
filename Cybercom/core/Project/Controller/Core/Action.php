<?php 

Ccc::loadClass('Model_Core_View');

class Controller_Core_Action {


	protected $view = null;

	public function redirect($url)
	{
		header("Location: $url");
		exit();
	}

	public function getView()
	{
		if (!$this->view)
		{

			$this->setView(new Model_Core_View());
		}
		return $this->view;
	}

	public function setView($view)
	{
		$this->view = $view;
		return $this;
	}
	public function getAdapte()
	{
		global $adapter;
		return $adapter;
	}
	public function getRequest()
	{
		return Ccc::getFront()->getRequest(); 
	}
	public function getUrl($c=null,$a=null,array $data = [],$reset = false)
	{
		$info = [];
		if($c==null && $a==null && $data==null && $reset==false){
			$info = $this->getRequest()->getRequest();
		}
		$info['c']= $c==null ?$this->getRequest()->getRequest('c') : $info['c']=$c ; 
		$info['a']= $a==null ?$this->getRequest()->getRequest('a') : $info['a']=$a ; 
		if($reset){
			if($data) {
				$info = array_merge($info,$data);
			}
		}
		else{
			$info = array_merge($this->getRequest()->getRequest(),$info);
			if($data) {
				$info = array_merge($info,$data);
			}	
		}
		$url = "index.php?".http_build_query($info);
		return $url;
	}	
}