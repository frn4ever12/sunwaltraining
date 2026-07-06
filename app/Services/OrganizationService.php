<?php

namespace App\Services;

use App\Repositories\Interfaces\OrganizationRepositoryInterface;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class OrganizationService
{
    use FileUploadTrait;
    protected $organizationRepository;

    public function __construct(OrganizationRepositoryInterface $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function updateOrganization(array $data, ?UploadedFile $newImageFile = null)
    {
        try {
            DB::beginTransaction();
            $setting = get_detail();
            $oldImagePaths = [
                'logo' => $setting->logo,
            ];

            $this->organizationRepository->updateOrganization($data);


            if ($newImageFile) {
                $this->deleteOldImage($oldImagePaths['logo']);
                $newImagePath = $this->uploadImage($newImageFile, 'organization/logo/');
                $setting->update(['logo' => $newImagePath]);
            }

            DB::commit();
            return $setting;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Error updating setting: " . $e->getMessage());
        }
    }
}
