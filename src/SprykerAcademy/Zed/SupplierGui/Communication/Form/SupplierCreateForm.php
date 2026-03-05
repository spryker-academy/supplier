<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SupplierCreateForm extends AbstractType
{
    public const string FIELD_NAME = 'name';

    public const string FIELD_DESCRIPTION = 'description';

    public const string FIELD_IS_ACTIVE = 'isActive';

    public const string FIELD_EMAIL = 'email';

    public const string FIELD_PHONE = 'phone';

    /**
     * @return string
     */
    #[\Override]
    public function getBlockPrefix(): string
    {
        return 'supplier';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // TODO-1: Add form fields using $builder->add()
        // Hint-1: Each field is added with $builder->add(fieldName, fieldType, optionsArray)
        // Hint-2: You can chain multiple ->add() calls: $builder->add(...)->add(...)->add(...)
        // Hint-3: Example for a text field with validation:
        //   $builder->add(static::FIELD_NAME, TextType::class, [
        //       'label' => 'Name',
        //       'constraints' => [
        //           $this->createNotBlankConstraint(),
        //       ],
        //   ])
        // Hint-4: For the isActive checkbox, use CheckboxType::class with 'mapped' => false and 'required' => false
        //   The 'data' option should come from $options[static::FIELD_IS_ACTIVE]
        //
        // Fields to add:
        //   - FIELD_NAME (TextType, NotBlank)
        //   - FIELD_DESCRIPTION (TextType, NotBlank)
        //   - FIELD_IS_ACTIVE (CheckboxType, unmapped, not required, default from options)
        //   - FIELD_EMAIL (TextType, NotBlank)
        //   - FIELD_PHONE (TextType, NotBlank)
    }

    /**
     * TODO-2: Override configureOptions() to set data_class and default options
     * Hint-1: Use $resolver->setDefaults() with 'data_class' => 'Generated\Shared\Transfer\SupplierTransfer'
     * Hint-2: Also set a default for static::FIELD_IS_ACTIVE => true
     * Hint-3: Use $resolver->setAllowedTypes(static::FIELD_IS_ACTIVE, 'bool') to enforce the type
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    #[\Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\NotBlank
     */
    protected function createNotBlankConstraint(): NotBlank
    {
        return new NotBlank();
    }
}
