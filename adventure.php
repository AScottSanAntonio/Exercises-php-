<?php
// Input / Output
function prompt($message)
{
    alert($message);
    return trim(fgets(STDIN));
}
function confirm($message)
{
    return strtolower(prompt($message)) === 'y';
}
function alert($message)
{
    fwrite(STDOUT, $message . PHP_EOL);
}
// Middleware
function loadContacts()
{
    $content = trim(file_get_contents('contacts.txt'));
    $lines = explode("\n", $content);
    $contacts = [];
    foreach ($lines as $line) {
        $contact = explode('|', $line);
        addContact($contacts, $contact[0], $contact[1]);
    }
    return $contacts;
}
function saveContacts($contacts)
{
    $content = '';
    foreach ($contacts as $contact) {
        $content .= implode('|', $contact) . "\n";
    }
    file_put_contents('contacts.txt', $content);
}
// Model
function addContact(&$contacts, $name, $number)
{
    $contacts[] = [
        'name' => $name,
        'number' => $number,
    ];
}
function searchContact($contacts, $name)
{
    $matches = [];
    foreach ($contacts as $contact) {
        if (strpos($contact['name'], $name) !== false) {
            $matches[] = $contact;
        }
    }
    return $matches;
}
function deleteContacts(&$contacts, $name)
{
    foreach ($contacts as $index => $contact) {
        if (strpos($contact['name'], $name) !== false) {
            unset($contacts[$index]);
        }
    }
}
// Validation
function isValidName($name)
{
    return !empty(trim($name));
}
function isValidPhoneNumber($phoneNumber)
{
    return !empty(trim($phoneNumber)) && is_numeric($phoneNumber)
        && (strlen($phoneNumber) == 7 || strlen($phoneNumber) == 10);
}
function inputName($message)
{
    $name = prompt($message);
    if (isValidName($name)) {
        return $name;
    }
    alert('Please enter a non-empty name');
    return inputName($message);
}
function inputNumber($message)
{
    $number = prompt($message);
    if (isValidPhoneNumber($number)) {
        return $number;
    }
    alert('Please enter a phone number with 7 or 10 digits');
    return inputNumber($message);
}
// View
function longestNameLength($contacts)
{
    $longest = -1;
    foreach ($contacts as $contact) {
        $nameLength = strlen($contact['name']);
        if ($nameLength > $longest) {
            $longest = $nameLength;
        }
    }
    return $longest;
}
function longestPhoneNumber($contacts)
{
    $longest = -1;
    $max = 12; // Max length for phone numbers is 12, after format
    foreach ($contacts as $contact) {
        $numberLength = strlen($contact['number']);
        $formatLength = $numberLength == 7 ? 1 : 2;
        if ($numberLength + $formatLength > $longest) {
            $longest = $numberLength + $formatLength;
        }
        if ($longest === $max) {
            break;
        }
    }
    return $longest;
}
function formatNumber($number) {
    if (strlen($number) == 7) {
        return substr($number, 0, 3) . '-' . substr($number, 3);
    }
    if (strlen($number) == 10) {
        return substr($number, 0, 3) . '-' . substr($number, 3, 3) . '-' . substr($number, 6);
    }
    return $number;
}
function formatContacts($contacts)
{
    $nameLength = longestNameLength($contacts);
    $phoneLength = longestPhoneNumber($contacts);
    array_unshift($contacts, ['name' => 'Name', 'number' => 'Phone']);
    $table = '';
    foreach ($contacts as $contact) {
        $table .= '| '
            . str_pad($contact['name'], $nameLength) . ' | '
            . str_pad(formatNumber($contact['number']), $phoneLength) . " |\n";
    }
    return $table;
}
// Controllers
function viewContacts($contacts)
{
    $contactsTable = formatContacts($contacts);
    alert($contactsTable);
}
function newContact(&$contacts)
{
    $name = inputName('Enter a new contact name:');
    $number = inputNumber('Enter phone number');
    $matches = searchContact($contacts, $name);
    if (count($matches) > 0) {
        $message = "There's already a contact named $name. Do you want to overwrite it? (y/n)";
        if (confirm($message)) {
            deleteContacts($contacts, $name);
        } else {
            newContact($contacts);
        }
    }
    addContact($contacts, $name, $number);
    alert('Contact saved successfully!');
}
function findContact($contacts)
{
    $name = inputName('Enter the name to search:');
    $matches = searchContact($contacts, $name);
    alert(formatContacts($matches));
}
function deleteContact(&$contacts)
{
    $name = prompt('Enter the name of the contact to delete:');
    deleteContacts($contacts, $name);
    alert('Contacts deleted successfully!');
}
// Front controller
function contactsManager()
{
    $menu = <<<MENU
1. View contacts.
2. Add a new contact.
3. Search a contact by name.
4. Delete an existing contact.
5. Exit.
Enter an option (1, 2, 3, 4 or 5):
MENU;
    do {
        $contacts = loadContacts();
        $option = prompt($menu);
        switch ($option) {
            case 1:
                viewContacts($contacts);
                break;
            case 2:
                newContact($contacts);
                break;
            case 3:
                findContact($contacts);
                break;
            case 4:
                deleteContact($contacts);
                break;
            default:
                alert('See you!');
        }
        saveContacts($contacts);
    } while ($option != 5);
}
contactsManager();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
            integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
            crossorigin="anonymous"
        >
        <title>Contacts manager</title>
    </head>
    <body>
        <div class="container">
            <section class="row">
                <div class="col-md-8">
                    <header class="page-header">
                        <h1>Contacts Manager</h1>
                    </header>
                </div>
                <div class="col-md-4" style="padding-top: 3.5em">
                    <form class="form-inline" method="get">
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control"
                                id="search-name"
                                placeholder="John Doe">
                        </div>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search" aria-hidden="true">
                            </span>
                            Search
                        </button>
                    </form>
                </div>
            </section>
            <article class="row contacts">
                <section class="col-md-6">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Your contacts should be here -->
                            <tr>
                                <td>John Doe</td>
                                <td>123-4557</td>
                                <td>
                                    <!-- The query string for this one should contain the contact name -->
                                    <a class="btn btn-danger" href="?name=John Doe">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true">
                                        </span>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="col-md-6">
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">
                                Name
                            </label>
                            <div class="col-sm-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="number" class="col-sm-2 control-label">
                                Number
                            </label>
                            <div class="col-sm-10">
                                <input
                                    type="number"
                                    class="form-control"
                                    name="number"
                                    id="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
                                    </span>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
            </article>
        </div>
        <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"
        ></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"
        ></script>
    </body>
</html>





