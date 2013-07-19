<?php
namespace AI;
class Response{
	protected $_body = array();
	public function appendBody($content, $key = NULL)
	{
		if (null == $key) {
            if (isset($this->_body['default'])) {
                $this->_body['default'] .= (string) $content;
            } else {
                return $this->setBody('default', $content);
            }
		}
	}
	
    public function setBody($key = NULL, $content)
    {
        if (isset($this->_body[$key])) {
            unset($this->_body[$key]);
        }
        $this->_body[$key] = (string) $content;
        return $this;
    }
    
    public function send()
    {
    	$content = implode('', $this->_body);
    	echo $content;
    }
    public function write($content){
    	$this->appendBody($content);
    	$this->send();
    }
}
?>