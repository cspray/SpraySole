<?php

/**
 * An enum that allows the reuse of common error codes across an application.
 * 
 * @author Charles Sprayberry
 * @license See LICENSE in source root
 */

namespace SpraySole;

/**
 * The error codes in this interface are repurposed from those used by the HTTP
 * protocol.
 *
 * We chose to use HTTP style error codes because thy're really the only standardized
 * set of comprehensive error codes that convey a reasonable amount of meaning while
 * still just being a number.
 */
interface ErrorCodes {

    const NO_ERROR = 0;

    const BAD_INPUT = 400;
    const COMMAND_NOT_FOUND = 404;





}
