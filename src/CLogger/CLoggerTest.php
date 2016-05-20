<?php
namespace krysvac\Logger;

include "CLogger.php";
class CLoggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     *
     * @return void
     *
     */
    public function testWriteErrors()
    {
        CLogger::init();

        $res = CLogger::writeErrors(E_WARNING, "Test", "Test.php", 1);
        $exp = true;
        $this->assertEquals($res, $exp, "Created element name missmatch.");
    }
}
