<?php

namespace App\Form;

use App\Entity\Skill;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class ,[
                "label" => "Nom de la compétence",
                "attr" => [
                    "placeholder" => "Entrez le nom de la compétence"
                ]
            ])
            ->add('level', RangeType::class , [
                "label" => "Niveau de la compétence :",
                "attr" => [
                    "min" => 1,
                    "max" => 10,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
