<?php

class NewsCPagination extends CPagination
{
    public function getOffset()
	{
        $offset = $this->getCurrentPage()*$this->getPageSize();
        
        if($this->getCurrentPage() > 0){
            return $offset + 1;
        }

		return $offset;
	}
}
?>