<?php

namespace SDK\Build\PGO;

use SDK\{Config as SDKConfig, Exception};
use SDK\Build\PGO\Config as PGOConfig;
use SDK\Build\PGO\Server\{MariaDB, NGINX};

/* TODO add bench action */

class Controller
{
	protected $cmd;
	protected $deps_root;
	protected $php_root;
	protected $conf;

	public function __construct(string $cmd, string $php_root, string $deps_root)
	{
		$this->cmd = $cmd;
		$this->php_root = $php_root;
		$this->deps_root = $deps_root;
	}

	public function handle()
	{
		$this->conf = new PGOConfig("init" !== $this->cmd);

		switch ($this->cmd) {
		default:
			throw new Exception("Unknown action '{$this->cmd}'.");
			break;
		case "init":
			$this->init();
			break;
		case "train":
			$this->train();
			break;
		case "up":
			$this->up();
			break;

		case "down":
			$this->down();
			break;
		}
		var_dump($this->conf);
	}

	public function init()
	{
		echo "pgo controller init";
	}

	public function isInitialized()
	{
		$base = getenv("PHP_SDK_ROOT_PATH");

		/* XXX Could be some better check. */
		return is_dir($base . DIRECTORY_SEPARATOR . "pgo" . DIRECTORY_SEPARATOR . "work");
	}

	public function train()
	{
		if (!$this->isInitialized()) {
			throw new Exception("PGO training environment is not initialized.");
		}
		echo "pgo controller train";

	}

	public function up()
	{
		if (!$this->isInitialized()) {
			throw new Exception("PGO training environment is not initialized.");
		}
		echo "pgo controller up";

	}

	public function down()
	{
		if (!$this->isInitialized()) {
			throw new Exception("PGO training environment is not initialized.");
		}
		/* XXX check it was started of course. */
		echo "pgo controller down";

	}
}