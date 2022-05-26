<?php

namespace App\Services;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelService {

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function createLabel() 
    {
        $label = Label::create(['title' => $this->request->title]);

        return $label;
    }

    public function updateLabel($id)
    {
        $label = Label::findorfail($id);

        $label->update(['title' => $this->request->title]);

        return $label;
    }

}