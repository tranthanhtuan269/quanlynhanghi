<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Hotel extends Model
{
    protected $table = "user_hotel";
    protected $fillable = [ 'id_user', 'id_hotel', 'privilege'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    
    public function getAllGuest($hotel){
        if($hotel!=''){
            $users = User::where('id_hotel', $hotel)->first();
            if($users !== null){
                $user->active = 0;
                $user->update();
                
                // send email thong bao nap tien
                Mail::send('emails.thongbaonaptien', [], function($message) use ($email) {
                    $message->from('admin@chodatso.com', 'chodatso.com');
                    $message->to($email)->subject('Thông báo từ chodatso.com');
                });
            }
        }
    }
}
