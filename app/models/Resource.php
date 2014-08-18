<?php

class Resource extends \Eloquent {

	// Add your validation rules here
	public static $rules = array(
        'type'			=> 'required',
        'name'			=> 'required|unique:resources,name',
        'description'	=> 'required|unique:resources,description',
        'school'		=> 'required',
        'year'			=> 'required',
        'file'			=> 'required|unique:resources,file',
        'unit'			=> 'required'
    );

    public static function getRulesForUpdate($id)
    {
        return [
                    'type'          => 'required',
                    'name'          => 'required|unique:resources,name,'.$id,
                    'description'   => 'required|unique:resources,description,'.$id,
                    'school'        => 'required',
                    'year'          => 'required',
                    'file'          => 'unique:resources,file,'.$id,
                    'unit'          => 'required'
        ];
    }

	// Don't forget to fill this array
	protected $fillable = ['school', 'year', 'unit', 'name', 'type', 'description', 'file', 'user_id', 'private', 'picture'];

	public function reviews()
    {
        return $this->hasMany('Review');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function users()
    {
        return $this->belongsToMany('User')->withTimestamps();;
    }


    public function scopeSearch($query, $search)
    {
        return $query
            ->where('name', 'LIKE', "%$search%")
            ->orWhere('description', 'LIKE', "%$search%")
            ->orWhere('school', 'LIKE', "%$search%")
            ->orWhere('year', 'LIKE', "%$search")
            ->orWhere('unit', 'LIKE', "%$search");
    }

    public function recalculateRating()
    {
        $reviews = $this->reviews()->notSpam()->approved();
        $avgRating = $reviews->avg('rating');
        $this->cache_rating = round($avgRating,1);
        $this->count_rating = $reviews->count();
        $this->save();
    }

    public static function getExtensionType($file, $destinationPath, $filename)
    {
        $extension = $file->getClientOriginalExtension();

        switch ($extension) {
            case 'pdf':
            case 'PDF':
                exec("convert -density 200 $destinationPath/$filename.pdf[0] eltdpPictures/$filename.jpg");     
                $pathToPicture = 'eltdpPictures/'. $filename .'.jpg';
                break;
            
            case 'doc':
            case 'DOC':
            case 'docx':
            case 'DOCX':
                $pathToLibre = 'LibreOffice2/cde-package/cde-root/home/robert/';
                $file = 'eltdpResources/'. $filename .'.'. $extension;
                $newfile = $pathToLibre . $filename .'.'. $extension;

                if(copy($file, $newfile)) {
                    chdir('LibreOffice2/cde-package/cde-root/home/robert/');
                    exec("libreoffice.cde --headless -convert-to pdf $filename.$extension");
                    exec("convert -density 200 $filename.pdf[0] ../../eltdpPictures/$filename.jpg");
                    if (file_exists ( 'eltdpPictures/'. $filename .'.jpg'))
                    { 
                        $pathToPicture = 'eltdpPictures/'. $filename .'.jpg';
                        break;
                    } else {
                        $pathToPicture = $pathToPicture = 'img/msWord.jpg';
                    }
                    break;
                }

                $pathToPicture = getcwd();
                break;
            
            case 'jpg':
            case 'JPG':
            case 'png':
            case 'PNG':
            case 'bmp':

                $file = 'eltdpResources/'. $filename .'.'. $extension;
                $newfile = 'eltdpPictures/'. $filename .'.'. $extension;

                if(copy($file, $newfile)) {
                    $pathToPicture = $newfile;
                    break;
                } else {
                    $pathToPicture = "failed to copy $file...\n";
                    break;
                }
            
            case 'mp3':
            case 'MP3':

                $pathToPicture = 'img/audio.png';
                break;

            case 'mp4':
            case 'MP4':
                exec("convert -quiet $destinationPath/$filename.mp4[100] eltdpPictures/$filename.png");     
                if (file_exists ( 'eltdpPictures/'. $filename .'.png'))
                    { 
                        $pathToPicture = 'eltdpPictures/'. $filename .'.png';
                        break;
                    } else {
                        $pathToPicture = $pathToPicture = 'img/video2.jpg';
                    }
                    break;
                
            case 'avi':
            case 'AVI':
                $pathToPicture = $pathToPicture = 'img/video2.jpg';
                break;
                
            default:
                $pathToPicture = null;
                break;
        }
        
        return $pathToPicture;
    }

}