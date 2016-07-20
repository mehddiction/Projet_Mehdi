<?php
namespace MEHDI\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MehdiUserBundle extends Bundle
{
	public function getParent(){
		return 'FOSUserBundle';
	}
}
