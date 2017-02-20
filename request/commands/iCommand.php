<?php

namespace platron_sdk\request\commands;

interface iCommand {
	public function getParameters();
	public function getRequestUrl();
}
