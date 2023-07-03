<?php

declare(strict_types=1);

namespace App\Command;

use App\Log;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Psr\Container\ContainerInterface;

#[Command]
class TestCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * 执行的命令行
     *
     * @var ?string
     */
    protected ?string $name = 'TestCommand';


    public function handle(): void
    {

        Log::get()->info("运行TestCommand任务:" . date("Y-m-d H:i:s"));

    }
}
