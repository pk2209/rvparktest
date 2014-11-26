<?php

class UploadController extends Controller {

    public function offerImageForm(){
        return View::make('template.offer-image-upload');
    }

    public function offerImageProcess(){
        if(Input::hasFile('image')){
            try{
                $image = Input::file('image');
                $id = Input::get('id');
                $path = (Input::get('predefined') == 1) ? 'predefined' : 'uploaded';
                if(!File::exists(public_path().'/images/'.$path.'/'.$id)){
                    File::makeDirectory(public_path().'/images/'.$path.'/'.$id);
                }

                $imagePath = '/images/'.$path.'/'.$id.'/'.$image->getClientOriginalName();
                $fullPath = public_path().$imagePath;

                Image::make($image->getRealPath())
                        ->widen(280)
                        ->save($fullPath);
                
                return View::make(
                    'template.offer-image-upload',
                    array(
                        'isResponse' => true, 
                        'imagePath' => $imagePath
                    )
                );
            }catch(Exception $e){
                return View::make(
                    'template.offer-image-upload',
                    array(
                        'isResponse' => true, 
                        'error' => $e->getMessage()
                    )
                );
            }
        }
    }
}