# PES_AssistMe_BackEnd
Apache2 Web Server using PHP 7.0. 

## Getting Started

The first that we must to know is the context.
![Alt text](/Images/ArquitecturaTecnica.png?raw=true "Arquitectura Técnica")
## Our server will response at 2 types of request.

1. From a mobile App returning a JSON
   * Sample of code:
    ~~~~
    <?PHP
    $data = /** whatever you're serializing **/;
    header('Content-Type: application/json');
    echo json_encode($data);
    ?>
    ~~~~
2. From a web browser control panel returning html and information about success or not with queries

## Patterns & Code organization.
Folders:
  ·root
    ·requests
    ·domain
    ·persistence
* All the request will be treated by php files inside requests folder ('~/peticiones_php').
* Domain Layer Pattern
  ** Every request will be linked with a transaction that it will return the corresponded response. A transaction is represented by a class that implements the abstract class Transaction.
  
* Abstract Factory Pattern
* Adapter Pattern
* Singleton Pattern
