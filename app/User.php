<?php
namespace GaneshaSIGE;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use GaneshaSIGE\Notifications\InvoicePaid;
use GaneshaSIGE\Notifications\UpdateSignature;
use GaneshaSIGE\Notifications\NewPost;
use GaneshaSIGE\Notifications\PlanCoordinadores;
use GaneshaSIGE\Notifications\RecuperarPass;
use GaneshaSIGE\Notifications\ModifPlanCoor;
use \Auth as Auth;
use GaneshaSIGE\Notifications\ResetPassword;
use Crypt;
use QrCode;
use GaneshaSIGE\QrReader;



use GaneshaSIGE\ModelPlandeEvaluacion;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = "users";

    protected $primaryKey = "id";

    protected $fillable = [
       'ci_usu', 'name', 'ape_usu', 'email', 'password', 'tlf', 'img_perfil',
    ];

    private $private_pass;

    protected $hidden = [
        'password', 'remember_token',
    ];



    public function planes(){
        return $this->hasMany('GaneshaSIGE\ModelPlandeEvaluacion', 'id_plan');
    }

    public function getNombreCompleto(){
        return $this->name." ".$this->ape_usu;
    }

    public function img_perfil(){
        return $this->img_perfil;
    }

      public function roles()
    {
        return $this->belongsToMany('GaneshaSIGE\ModelRol', 'mrol_usus', 'id_tru', 'id_rol_tru');
    }
  
    public function generateNotify(){
        try {
            $this->notify(new InvoicePaid($this));
        } 
        catch (Exception $e) {}
    }

    public function generateNotifyPlan($busquedasec, $uni){
        try {
            //dd($uni,$busquedasec);
            $this->notify(new NewPost($this,$busquedasec,$uni));
        } 
        catch (Exception $e) {}
    }

    public function generateNotifyPlanCor($user2,$busquedasec, $uni){
        try {
            $this->notify(new Plancoordinadores($this,$user2,$busquedasec,$uni));
        } catch (Exception $e) {}
    }

    public function generateNotifyPlanModifCor($user2,$busquedasec,$uni,$EmailFecpart, $EmailFecprop,$EmailInst,$EmailObservacion,$EmailUnidad,$EmailViejoInst){
        try {
            //dd($EmailViejoInst[0]);
            $this->notify(new ModifPlanCoor($this,$user2,$busquedasec,$uni,$EmailFecpart, $EmailFecprop,$EmailInst,$EmailObservacion,$EmailUnidad,$EmailViejoInst));
        } 
        catch (Exception $e) {}
    }

     public function generateNotifyPass(){
        try {
            $this->notify(new RecuperarPass($this));
        } 
        catch (Exception $e) {}
    }

     public function MasterPuente_User_Plan(){
        return $this->belongsToMany('GaneshaSIGE\ModelPlandeEvaluacion', 'mpuentemasters',  'id_usu', 'id_plan', 'cod_seccion', 'coordinador');
    }
//Super Puente

    //de usuarios a unidades
    public function MasterPuente_User_UniCrr(){
        return $this->belongsToMany('GaneshaSIGE\ModelUnidadCurricular', 'mpuentemasters',  'id_usu', 'cod_unidad', 'cod_seccion', 'coordinador');
    }

    //de usuarios a secc
    public function MasterPuente_User_Secc(){
        return $this->belongsToMany('GaneshaSIGE\ModelSeccion', 'mpuentemasters',  'id_usu', 'cod_seccion', 'cod_unidad', 'coordinador');
    }



    public function tienerolesMod($var){
        foreach($this->roles as $role)
            if($role->tieneModulo($var))
                return true;
        return false;
    }

    public function tieneroles($nom_rol){
        foreach($this->roles as $rol)
            if($nom_rol == $rol->nom_rol)
                return true;
        return false;
    }








    public function tieneUC($unidad,$id){
        $var=DB::table('mpuentemasters')->where('cod_unidad', $unidad)->where('id_usu', $id)->get(['cod_unidad']);
        $var2=count($var);
            if ($var2 >0)
                return true;
        return false;
    }

    public function tieneUCCor($unidad,$id){
        $var=DB::table('mpuentemasters')->where('cod_unidad', $unidad)->where('id_usu', $id)->where('coordinador', 'TRUE')->get(['cod_unidad']);
        $var2=count($var);
            if ($var2 >0)
                return true;
        return false;
    }

    public function notieneUC($unidad,$id){
        $var=DB::table('mpuentemasters')->where('cod_unidad', $unidad)->where('id_usu', $id)->get(['cod_unidad']);
        $var2=count($var);
            if ($var2 >0)
                return false;
        return true;
    }

    public function sendPasswordResetNotification($token)
        {
            $this->notify(new ResetPassword($token));
        }

    public function generateNotifySignature($private_pass){
        try {
            $this->notify(new UpdateSignature($this,$private_pass));
        } 
        catch (Exception $e) {}
    }

    public function updateSignature(){

        $users = User::all();

        foreach ($users as $user) {
            $userm= New User;

            $userm->private_pass =$userm -> passPublic;

            $private_pass=$userm->private_pass;
  
            $user->generateNotifySignature((new UpdateSignature($user,$private_pass)));

            $ci=$user->ci_usu;
     
            $userm->qrGenerador($ci,$private_pass);

        }
        
        return redirect('home')->with(['tipoMsj' => 'success', 'msj' => 'Las firmas fueron enviadas con Exito', 'titulo' => 'Firma Enviada']);
    }

    public function getPassPublicAttribute(){
        $randomName=rand(0,20);
        $arrayName=[
          'Ganesha','Pegasus','Cardenal','Obelisco','Sativa',
          'Blaziken','Draco','Bolivar','Lara','Jirachi',
          'Glass','Colmena','Roraima','Tempus','Eros',
          'PES','Shiva','Loki','Sumus','Nobis','Eloy'];
        $randomNumber= rand(99,999);
        $publicPass = $randomNumber.$arrayName[$randomName];

        $this->private_pass = $publicPass;

        return $publicPass;
    }

    public function qrGenerador($ci_usu, $passPublic){
        QrCode::format('png')->size(399)->color(76, 175, 80)->merge('/public/img/logoss.png', .2)->errorCorrection('H')->generate(Crypt::encrypt($passPublic), '../public/qr_image/'.$ci_usu.'.png');  
    }

    public function qrScan(){
        $ci_usu = Auth::user()->ci_usu;
        $qrcode = new \QrReader('../public/qr_image/'.$ci_usu.'.png');
        $text = $qrcode->text(); //return decoded text from QR Code
        return $text;
    }

}
