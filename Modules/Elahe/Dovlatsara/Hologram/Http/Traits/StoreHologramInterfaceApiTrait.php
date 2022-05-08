<?php namespace Modules\Hologram\Http\Traits;

use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Hologram\Repositories\HologramRepository;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\HologramInterface\Entities\HologramInterfaceFile;

trait StoreHologramInterfaceApiTrait
{
    use UploadFileTrait;

    private $repo;

    public function __construct(HologramRepository $hologramRepository)
    {
        $this->repo = $hologramRepository;
    }

    public function storeHologramInterfaceWithFiles($request, $user)
    {
        $hologram = $this->repo->hologramFindById($request['hologram_id']);

        $hologram_interface = HologramInterface::create([
            'hologram_id' => $hologram->id,
            'type' => $hologram->type,
            'type_id' => $request['type_id'],
            'description' => isset($request['description'])?$request['description']:null,
            'hologram_price' => $hologram->price,
            'created_user'=> $user->id,
        ]);
        if (isset($request['files'])) {
            foreach ($request['files'] as $file) {
                if ($file != null) {
                    $im = $this->uploadFile($file, 'public/upload/hologram/apply/' . $user->id . '/' . now()->year
                        . '/' . now()->month);
                    HologramInterfaceFile::create([
                        'hologram_interface_id' => $hologram_interface->id,
                        'file_address' => $im,
                        'file_name' => $file->getClientOriginalName(),
                        'created_user'=>$user->id,
                    ]);
                }
            }
        }
    }

    public function storeHologramInterfaceWithFilesAuto($request, $id, $user)
    {
        $hologram = $this->repo->hologramFindById($request['hologram_id']);

        $hologram_interface = HologramInterface::create([
            'hologram_id' => $hologram->id,
            'type' => $hologram->type,
            'type_id' => $request['type_id'],
            'description' => isset($request['description'])?$request['description']:null,
            'hologram_price' => $hologram->price,
            'expert_id'=>$id,
        ]);
        if (isset($request['files'])) {
            foreach ($request['files'] as $file) {
                if ($file != null) {
                    $im = $this->uploadFile($file, 'public/upload/hologram/apply/' . $user->id . '/' . now()->year
                        . '/' . now()->month);
                    HologramInterfaceFile::create([
                        'hologram_interface_id' => $hologram_interface->id,
                        'file_address' => $im,
                        'file_name' => $file->getClientOriginalName()
                    ]);
                }
            }
        }
    }
}
