<?php

namespace App\Controller\Admin;

use App\Entity\Outing;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OutingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Outing::class;
    }
    
    public function configureFields(string $outionName): iterable
    {
        yield ImageField::new('outingFile')
            ->setBasePath('uploads/outingImages')
            ->setUploadDir('public/images/build');
        yield DateField::new('createdAt')
            ->hideOnForm();
        yield TextEditorField::new('description');
        // yield DateField::new('date');
    }
}
