# Contributing to SpraySole

SpraySole is an OSS project and gladly welcomes all pull requests for bug fixes, feature additions and maintainability refactorings. If you plan on contributing to the SpraySole project we request that you adhere to the following guidelines.

## Follow coding guidelines!

For existing code refactors or additions the coding standard used MUST follow the project's coding standards which can be found at [`cspray/coding_guidelines`](https://github.com/cspray/coding_guidelines). For a new module freshly added independent of existing code then PSR coding standards may be used but it is **strongly** advised that all code in the SpraySole project follows the coding standards set.

## Provide unit tests!

Bug fixes and feature requests should have unit tests written for them. SpraySole is developed using Test Driven Development philosophies and any bug fixes or features requiring any more logic then getting a simple property should have tests. If you don't provide tests in your PR it is likely to be rejected until the appropriate tests have been added.

SpraySole uses PHPUnit 3.7+ as its unit testing framework.

## Document your code!

Don't comment every line explaining what the line is doing but do put docblocks on any new members explaining types, return values, parameters and exceptions thrown. An explanation in the docblock is also recommended but is not necessary if the class or member is simple enough. Hacky or weird solutions that aren't intuitive SHOULD be commented in-line.


Again, we welcome all contributions and request that you follow the guidelines set when submitting a PR to the project.
