<?php

require_once "classes/CartItem.php";
require_once "classes/DBAccess.php";

class shoppingCart{
    private $_cartItems = [];//items that included in the shopping cart
    private $_shoppingOrderId;//This is the ID for the shopping cart

    public function setShoppingOrderID($id){
        $this->_shoppingOrderId = (int)$id;
    }

    public function count(){
        return count($this->_cartItems);
    }

    public function countQtyOfOneItem($itemId){
        $index = -1;

        for ($i=0;$i<$this->count();$i++){
            if ($itemId == $this->_cartItems[$i]->getItemId()){
                $index = $i;
            }
        }

        $qty = $this->_cartItems[$index]->getQuantity();
        return $qty;
    }

    public function getItems(){        //check what has been put in the shopping cart
        return $this->_cartItems;
    }

    public function addItem($cartItem){        //add item to shopping cart, $cartItem is SINGLE
        $found = $this->ifInCart($cartItem);      //first check if the cartItem already exists in the cart

        if ($found == null){
            $this->_cartItems[]=$cartItem;
        }else{
            $this->updateItem($cartItem);
        }
    }
    
    public function ifInCart($cartItem){          //check if item exists in cart
        $found = null;

        foreach ($this->_cartItems as $item){
            if ($item->getItemId()==$cartItem->getItemId()){
                $found = $item;
            }
        }

        return $found;
    }

    public function itemIndex($cartItem){       //first found the item to be updated
        $index = -1;

        for ($i=0;$i<$this->count();$i++){
            if ($cartItem->getItemId() == $this->_cartItems[$i]->getItemId()){
                $index = $i;
            }
        }

        return $index;
    }

    public function updateItem($cartItem){      //update the quantity of the items that already exist in cart
        $index = $this->itemIndex($cartItem);   //first found the item to be updated

        $oldQty = $this->_cartItems[$index]->getQuantity();
        $additionalQty = $cartItem->getQuantity();    //this is the amount that to be added to existing quantity
        $newQty = $oldQty + $additionalQty;

        $this->_cartItems[$index]->setQuantity($newQty);

    }

    public function setItemQty($itemId,$qty){
        $index = -1;
        for ($i=0;$i<$this->count();$i++){
            if ($itemId == $this->_cartItems[$i]->getItemId()){
                $index = $i;
            }
        }

        $this->_cartItems[$index]->setQuantity($qty);
    }

    public function removeItem($cartItem){
        $index = $this->itemIndex($cartItem);

        if ($index >= 0){
            unset($this->_cartItems[$index]);   //clear data at the index
            $this->_cartItems = array_values($this->_cartItems); //built-in function, return an array containing all the values of an array.
        }
    }

    public function calculateTotal(){
        $total = 0.0;

        foreach ($this->_cartItems as $item){
            $total += $item->getPrice() * $item->getQuantity();
        }

        return $total;
    }

    public function saveCart($Address,
                            $ContactNumber,
                            $CreditCardNumber,
                            $CSV,
                            $Email,
                            $ExpiryDate,
                            $FirstName,
                            $LastName,
                            $NameOnCard)
    {    
        include "settings/db.php";

        $db = new DBAccess($dsn,$username,$password);       //This is to save the order in the database, just order number and other details
        $pdo = $db->connect();
        $sql = "insert into Shoppingorder(Address,
                                        ContactNumber,
                                        CreditCardNumber,
                                        CSV,
                                        Email,
                                        ExpiryDate,
                                        FirstName,
                                        LastName,
                                        NameOnCard,
                                        OrderDate)
                            values( :Address,
                                    :ContactNumber,
                                    :CreditCardNumber,
                                    :CSV, :Email,
                                    :ExpiryDate,
                                    :FirstName,
                                    :LastName,
                                    :NameOnCard,
                                    curdate())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":Address" , $Address, PDO::PARAM_STR);
        $stmt->bindValue(":ContactNumber" , $ContactNumber, PDO::PARAM_STR);
        $stmt->bindValue(":CreditCardNumber" , $CreditCardNumber, PDO::PARAM_STR);
        $stmt->bindValue(":CSV" , $CSV, PDO::PARAM_STR);
        $stmt->bindValue(":Email" , $Email, PDO::PARAM_STR);
        $stmt->bindValue(":ExpiryDate" , $ExpiryDate, PDO::PARAM_STR);
        $stmt->bindValue(":FirstName" , $FirstName, PDO::PARAM_STR);
        $stmt->bindValue(":LastName" , $LastName, PDO::PARAM_STR);
        $stmt->bindValue(":NameOnCard" , $NameOnCard, PDO::PARAM_STR);

        $shoppingOrderID = $db->executeNonQuery($stmt, true);

        //This is to store what items are in a specific order
        foreach ($this->_cartItems as $item){
            $sql = "insert into orderitem(  itemID,
                                            price,
                                            quantity,
                                            shoppingOrderID)
                                values( :ItemID,
                                        :Price,
                                        :Quantity,
                                        :shoppingOrderID)";
            //for each item insert a row in OrderItem
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":ItemID" , $item->getItemId(), PDO::PARAM_INT);
            $stmt->bindValue(":Price" , $item->getPrice(), PDO::PARAM_STR);
            $stmt->bindValue(":Quantity" , $item->getQuantity(), PDO::PARAM_INT);
            $stmt->bindValue(":shoppingOrderID" , $shoppingOrderID, PDO::PARAM_INT);
            $db->executeNonQuery($stmt);
        }

        return $shoppingOrderID;
    }

    public function displayArray(){
        print_r($this->_cartItems);     //This is just testing purpose
    }
}




?>