<?php

namespace Tech\Rkeeper\XmlConverter\Traits;

trait OrderTrait {

    public function setOrderParamsToCreateOrderXml(Array $orderParams): string
    {
        $xmlBody = $this->createDomDocumentObject();
        $query = $xmlBody->createElement("RK7Query");
        $query = $xmlBody->appendChild($query);

        $command = $xmlBody->createElement("RK7CMD");
        $command->setAttribute("CMD","CreateOrder");
        $command = $query->appendChild($command);

        $order = $xmlBody->createElement("Order");
        //
        $comment = $orderParams["COMMENT"];
        $order->setAttribute("persistentComment", $comment);
        //
        $order = $command->appendChild($order);
        
        $orderCategory = $xmlBody->createElement("OrderCategory");
        $orderCategory->setAttribute("id", $orderParams["ORDER_CATEGORY"]);
        $orderCategory = $order->appendChild($orderCategory);

        $orderType = $xmlBody->createElement("OrderType");
        $orderType->setAttribute("id", $orderParams["ORDER_TYPE"]);
        $orderType = $order->appendChild($orderCategory);

        $table = $xmlBody->createElement("Table");
        $table->setAttribute("code",$orderParams["TABLE"]);
        $table = $order->appendChild($table);

        $guestType = $xmlBody->createElement("GuestType");
        $guestType->setAttribute("id", "1");
        $guestType = $order->appendChild($guestType);

        $guests = $xmlBody->createElement("Guests");
        $guest = $xmlBody->createElement("Guest");
        $guest->setAttribute("GuestLabel", "1");
        $guest = $guests->appendChild($guest);
        $guests = $order->appendChild($guests);
        
        return $xmlBody->saveXml();
    }

    public function setOrderParamsToUpdateOrderXml(Array $orderParams): string
    {
        $xmlBody = $this->createDomDocumentObject();
        $query = $xmlBody->createElement("RK7Query");
        $query = $xmlBody->appendChild($query);

        $command = $xmlBody->createElement("RK7CMD");
        $command->setAttribute("CMD","SaveOrder");
        $command->setAttribute("deferred","1");
        $command = $query->appendChild($command);

        $order = $xmlBody->createElement("Order");
        //
        $guid = $orderParams["GUID"];
        $order->setAttribute("guid", $guid);
        //
        $order = $command->appendChild($order);
        
        $session = $xmlBody->createElement("Session");
        $session = $command->appendChild($session);

        foreach($orderParams["DISHES"] as $orderDish)
        {
            $dish = $xmlBody->createElement("Dish");
            $dish->setAttribute("id",$orderDish[3]);
            $dish->setAttribute("quantity",$orderDish[1]);
            $dish = $session->appendChild($dish);
        }
        return $xmlBody->saveXml();
    }

    public function setOrderResultToPayOrderXml(string $xmlString): string
    {
        $xmlBody = $this->createDomDocumentObject();
        $query = $xmlBody->createElement("RK7Query");
        $query = $xmlBody->appendChild($query);

        $command = $xmlBody->createElement("RK7CMD");
        $command->setAttribute("CMD","PayOrder");
        $command = $query->appendChild($command);

        $order = $xmlBody->createElement("Order");
        //
        $guid = $this->getOrderGuid($xmlString);
        $order->setAttribute("guid", $guid);
        //
        $order = $command->appendChild($order);
        
        $payment = $xmlBody->createElement("Payment");
        //
        $paySum = $this->getOrderSum($xmlString);
        $payment->setAttribute("id", "1");
        $payment->setAttribute("amount", $paySum*100);
        //
        $payment = $command->appendChild($payment);
        
        return $xmlBody->saveXml();
    }

    public function getOrderGuid($xmlString): string
    {
        $xmlObject = $this->createDomDocumentObject();
        $xmlObject->loadXml($xmlString);
        $result = $xmlObject->getElementsByTagName("Order")[0];
        if($result != false)
            return $result->getAttribute("guid");
        else
            return "error";
    }

    public function getOrderSum($xmlString): string
    {
        $xmlObject = $this->createDomDocumentObject();
        $xmlObject->loadXml($xmlString);
        $result = $xmlObject->getElementsByTagName("Order")[0];
        if($result != false)
            return $result->getAttribute("basicSum");
        else
            return "error";
    }
}