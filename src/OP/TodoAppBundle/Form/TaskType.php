<?


namespace OP\TodoAppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
    	$builder->add('text', 'textarea', array('label'=>'Task') );
        $builder->add('deadline', 'datetime', array('label'=>'Deadline', 'date_format'=>'dd MM yyyy'));
    }

    public function getName()
    {
        return 'task';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'OP\TodoAppBundle\Entity\Task'
        );
    }
}
