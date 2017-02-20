<?php

namespace platron\request\commands;

interface iCommand {
	public function getParameters();
	public function getRequestUrl();
}
