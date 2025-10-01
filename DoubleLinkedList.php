<?php

class Node {
    public $data;
    public $next;
    public $prev;
    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
        $this->prev = null;
    }
}

class DoubleLinkedList {
    public $head;
    public $tail;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
    }

    // Add at the end
    public function append($data)
    {
        $newNode = new Node($data);

        if ($this->head === null) {
            $this->head = $newNode;
        } else {
            $this->tail->next = $newNode;
            $newNode->prev = $this->tail;
        }
        $this->tail = $newNode;
    }

    // Add at the start
    public function prepend($data)
    {
        $newNode = new Node($data);
        if ($this->head === null) {
            $this->tail = $newNode;
        } else {
            $this->head->prev = $newNode;
            $newNode->next = $this->head;
        }
        $this->head = $newNode;
    }

    public function insertAt($index, $data)
    {
        if ($index < 0) {
            throw new Exception("Index cannot be negative.");
        }

        if ($index === 0) {
            $this->prepend($data);
            return;
        }

        $current = $this->head;
        $i = 0;

        while ($current->next !== null && $i < $index) {
            $current = $current->next;
            $i++;
        }

        // Add at the end if teh index is greater than the list length
        if ($current->next === null && $i < $index) {
            $this->append($data);
        } else {
            $newNode = new Node($data);
            $previous = $current->prev;
            $previous->next = $newNode;
            $newNode->prev = $previous;

            $newNode->next = $current;
            $current->prev = $newNode;
        }
    }


    public function traversForward()
    {
        $current = $this->head;
        $result = [];

        while ($current !== null) {
            $result[] = $current->data;
            $current = $current->next;
        }

        return $result;
    }
    public function printForward()
    {
        echo "Forward: " . implode(" -> ", $this->traversForward()) . PHP_EOL;
    }
}

$list = new DoubleLinkedList();
$list->append(4);
$list->append(5);
$list->prepend(3);

try {
    $list->insertAt(2, 10);
    $list->insertAt(3, 11);
    $list->insertAt(5, 12);
} catch (Exception $e) {
    exit($e->getMessage());
}

$list->printForward();