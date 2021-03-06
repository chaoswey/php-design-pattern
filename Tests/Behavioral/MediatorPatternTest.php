<?php

namespace Tests\Behavioral;

use DesignPatterns\Behavioral\MediatorPattern\Bag;
use DesignPatterns\Behavioral\MediatorPattern\BagStoreMediator;
use DesignPatterns\Behavioral\MediatorPattern\Store;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class MediatorPatternTest.
 */
class MediatorPatternTest extends TestCase
{
    /**
     * @test
     */
    public function test_buy_and_sell_turnips()
    {
        $mediator = new BagStoreMediator(new Bag(), new Store());
        $mediator->setBells(10000);

        $this->expectOutputString(implode(array(
            "[背包] 剩下 10000 鈴錢。",
            "[玩家] 您購買了 40 顆大頭菜，每顆單價 100 鈴錢，總共 4000 鈴錢。",
            "[背包] 剩下 6000 鈴錢。",
            "[商店] 收到了 4000 鈴錢。",
            "[商店] 賣出了 40 顆大頭菜。",
            "[背包] 剩下 40 顆大頭菜。",
            "[玩家] 您販賣了 20 顆大頭菜，每顆單價 200 鈴錢，總共 4000 鈴錢。",
            "[背包] 剩下 20 顆大頭菜。",
            "[商店] 收購了 20 顆大頭菜。",
            "[商店] 支出了 4000 鈴錢。",
            "[背包] 剩下 10000 鈴錢。",
        )));

        $mediator->buyTurnips(100, 40);
        $mediator->sellTurnips(200, 20);
    }

    /**
     * @test
     */
    public function test_buy_turnips_overflow()
    {
        $this->expectException(InvalidArgumentException::class);

        $mediator = new BagStoreMediator(new Bag(), new Store());
        $mediator->buyTurnips(100, 200);
    }

    /**
     * @test
     */
    public function test_sell_turnips_overflow()
    {
        $this->expectException(InvalidArgumentException::class);

        $mediator = new BagStoreMediator(new Bag(), new Store());
        $mediator->sellTurnips(100, 40);
    }
}
