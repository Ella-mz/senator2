<?php namespace Modules\Hologram\Http\Traits;

use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Hologram\Entities\Hologram;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\HologramInterface\Entities\HologramInterfaceFile;

trait StoreHologramInterfaceTrait
{
    use UploadFileTrait;

    public function storeHologramInterfaceWithFiles($request)
    {
        $hologram = Hologram::find($request['hologram_id']);

        $hologram_interface = HologramInterface::create([
            'hologram_id' => $hologram->id,
            'type' => $hologram->type,
            'type_id' => $request['type_id'],
            'description' => $request['description'],
            'hologram_price' => $hologram->price,
            'created_user'=> \auth()->id(),
        ]);
        if (isset($request['holoFile'])) {
            foreach ($request['holoFile'] as $file) {
                if ($file != null) {
                    $im = $this->uploadFile($file, 'public/upload/hologram/apply/' . \auth()->id() . '/' . now()->year
                        . '/' . now()->month);
                    HologramInterfaceFile::create([
                        'hologram_interface_id' => $hologram_interface->id,
                        'file_address' => $im,
                        'file_name' => $file->getClientOriginalName(),
                        'created_user'=> \auth()->id(),
                    ]);
                }
            }
        }
        return $hologram_interface;
    }

    public function storeHologramInterfaceWithFilesAuto($request, $id)
    {
        $hologram = Hologram::find($request['hologram_id']);

        $hologram_interface = HologramInterface::create([
            'hologram_id' => $hologram->id,
            'type' => $hologram->type,
            'type_id' => $request['type_id'],
            'description' => $request['description'],
            'hologram_price' => $hologram->price,
            'expert_id'=>$id,
        ]);
        if (isset($request['holoFile'])) {
            foreach ($request['holoFile'] as $file) {
                if ($file != null) {
                    $im = $this->uploadFile($file, 'public/upload/hologram/apply/' . \auth()->id() . '/' . now()->year
                        . '/' . now()->month);
                    HologramInterfaceFile::create([
                        'hologram_interface_id' => $hologram_interface->id,
                        'file_address' => $im,
                        'file_name' => $file->getClientOriginalName()
                    ]);
                }
            }
        }
        return $hologram_interface;

    }
}
