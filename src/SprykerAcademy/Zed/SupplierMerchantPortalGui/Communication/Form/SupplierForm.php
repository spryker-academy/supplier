<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierMerchantPortalGui\Communication\Form;

use Generated\Shared\Transfer\SupplierTransfer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SupplierForm extends AbstractType
{
    /**
     * @var string
     */
    public const FIELD_NAME = 'name';

    /**
     * @var string
     */
    public const FIELD_DESCRIPTION = 'description';

    /**
     * @var string
     */
    public const FIELD_EMAIL = 'email';

    /**
     * @var string
     */
    public const FIELD_PHONE = 'phone';

    /**
     * @var string
     */
    public const FIELD_IS_ACTIVE = 'isActive';

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SupplierTransfer::class,
        ]);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // TODO: Add form fields using $builder->add()
        // Hint: FIELD_NAME => TextType (required, NotBlank constraint)
        // Hint: FIELD_DESCRIPTION => TextareaType (optional)
        // Hint: FIELD_EMAIL => EmailType (required, NotBlank constraint)
        // Hint: FIELD_PHONE => TextType (optional)
        // Hint: FIELD_IS_ACTIVE => CheckboxType (property_path: 'status')
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'supplierForm';
    }
}
