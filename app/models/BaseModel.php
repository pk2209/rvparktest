<?php

class BaseModel extends Eloquent{
    protected $hidden = array('Created', 'Updated');
}
