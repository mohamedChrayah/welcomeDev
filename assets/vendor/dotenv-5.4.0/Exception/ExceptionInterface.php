<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Dotenv\Exception;

require_once(__DIR__.'\FormatExceptionContext.php');

/**
 * Interface for exceptions.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface ExceptionInterface extends \Throwable
{
}
