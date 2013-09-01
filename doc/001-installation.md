# SpraySole Installation

There are two recommended ways to install SpraySole: through Composer or through Git and GitHub.

## Composer installation

We assume that you've already gotten Composer installed and aliased to the console command `composer`.

```shell
composer require cspray/spraysole:0.1.0a
```

or add to your `composer.json` file:

```json
{
    "require": {
        "cspray/spraysole": ">= 0.1.0a"
    }
}
```

## Git installation

Installing through git is just as simple as using Composer.

```shell
git clone https://github.com/cspray/SpraySole.git
```

---

It is recommended that you configure an alias for your system to execute the appropriate PHP file.

On *nix systems that should look something like:

```shell
alias spraysole="php /path/to/spraysole/console.php";
```

After you have setup your alias execute:

```shell
spraysole --version
```

You should see something that looks like the following:

```shell
SpraySole version 0.1.0alpha
    A console driven application powered by PHP 5.4+
```

If so, congratulations! If not, make sure you have setup your alias to execute the appropriate path with PHP. If you still encounter problems please report the issue to [SpraySole's issue tracker](https://github.com/cspray/SpraySole/issues).
