<?php
namespace Exbil\Mailcow\Quarantine;

use Exbil\MailCowAPI;

class Quarantine {
    private $MailCowAPI;

    public function __construct(MailCowAPI $MailCowAPI){
        $this->MailCowAPI = $MailCowAPI;
    }

    /**
     * `deleteItem()` - Delete an item form quarantine
     * @param string $id
     * @return array
     */
    public function deleteItem(string $id){
        return $this->MailCowAPI->post('delete/qitem', [$id]);
    }

    /**
     * `getAllQuarantineMails()` - Returns all quarantined emails
     * @return array
     */
    public function getAllQuarantineMails(){
        return $this->MailCowAPI->get('get/quarantine/all');
    }

    /**
     * `editQuarantineItems` - Edit one or multiple items in quarantine
     * @param array $items  An array of items to edit, e.g. ['item1', 'item2', 'item3']
     * @param string $action The action to perform on the items, e.g. 'release', 'delete', 'quarantine'
     * @return array
     */
    public function editQuarantineItems(array $items, string $action){
        return $this->MailCowAPI->post('edit/qitem', [
            "items" => $items,
            "attr" => [
                "action" => $action
            ]
        ]);
    }
}