# GS Action Management

by [richjenks.com](http://richjenks.com)

Allows Get Simple CMS developers to view registered Actions or remove them from the $plugins global before they are executed.

Includes two plugins:

- Show Actions
- Remove Actions

## Show Actions

When enabled, a table of all registered Actions will be displayed at the bottom of the Admin area and the active theme's footer (*i.e.* the front-end website).

This information is necessary to remove an Action. Note that only Actions registered on the page you are currently on will be shown, so an Action which affects a theme may not be registered in the Admin area and therefore would not exist in the table.

## Remove Actions

When enabled, the `remove_action` function is exposed which allow developers to remove Actions from the $plugins global before they are executed.

### Usage

```php
remove_action($hook, $function, $file);
```

Information displayed by the Show Actions plugin will aid in finding the parameters for `remove_action`.

## Installation

Copy `show_actions.php` and `remove_action.php` into the `plugins` directory and activate in the admin area.
