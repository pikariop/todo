<?php

namespace OP\TodoAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use OP\TodoAppBundle\Entity\Task;
use OP\TodoAppBundle\Form\TaskType;

class TodoAppController extends Controller
{
	
	public function indexAction()
	{
		return $this->redirect($this->generateUrl('OPTodoAppBundle_list'));
	}


	private function createTaskForm($task=null, $setDefaultDeadline=false)
	{
		if (!$task) 
			$task = new Task();	
	
		if ($setDefaultDeadline)
			$task->setDeadline(new \DateTime('now'));	
		return $this->createForm(new TaskType(), $task);
	}

	private function getTaskRepository()
	{
		return $this->getDoctrine()
			->getRepository('OPTodoAppBundle:Task');
	}
	
	private function getTasksTodo()
	{
		$repository = $this->getTaskRepository();
			
		$query = $repository->createQueryBuilder('t')
			->where('t.completed = false')
			->getQuery();
		
		return $query->getResult();
	}

	private function getTasksCompleted()
	{
		$repository = $this->getTaskRepository();
		
		$query = $repository->createQueryBuilder('t')
			->where('t.completed = true')
			->getQuery();
			
		return $query->getResult();
	}

	public function listAction(Request $request, $taskForm=null, $updateID=null)
	{
		$tasksTodo = $this->getTasksTodo();
			
		$tasksCompleted = $this->getTasksCompleted();
			
		if ($taskForm)
			$form = $taskForm;
		else
			$form = $this->createTaskForm(null,true);
		
		return $this->render
		(
			'OPTodoAppBundle:TodoApp:index.html.twig', 
			array
			(
				'tasksTodo'=>$tasksTodo, 
				'tasksCompleted'=>$tasksCompleted, 
				'form'=>$form->createView(),
				'updateID'=>$updateID
			)
		);
	}

	public function createAction(Request $request)
	{
		$task = new Task();
		$form = $this->createTaskForm($task);

		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);

			if ($form->isValid())
			{
				$task->setCompleted(false);
				$task->setDateAdded(new \DateTime('now'));
				$em = $this->getDoctrine()->getEntityManager();
			    $em->persist($task);
				$em->flush();

				return $this->redirect($this->generateUrl('OPTodoAppBundle_list'));
			}
		}
		return $this->redirect($this->generateUrl('OPTodoAppBundle_list'));
	}
	
	public function deleteAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$task = $em->getRepository('OPTodoAppBundle:Task')->find($id);
		
		if ($task) 
		{
			$em->remove($task);
			$em->flush();
		}
		
		return $this->redirect($this->generateUrl('OPTodoAppBundle_list'));
	}

	public function markCompleteAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$task = $em->getRepository('OPTodoAppBundle:Task')->find($id);
		if ($task) 
		{	
			$task->setCompleted(!$task->getCompleted());	
			$task->setDateCompleted(new \DateTime('now'));

			$em->flush();
		}
		
		return $this->redirect($this->generateUrl('OPTodoAppBundle_list'));
	}

	public function updateAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$task = $em->getRepository('OPTodoAppBundle:Task')->find($id);

		$form = $this->createTaskForm($task);
		
		if ($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);

			if ($form->isValid())
			{
				$em->flush();
				return $this->redirect($this->generateUrl('OPTodoAppBundle_list'));
			}
		}
		return $this->listAction($request, $form, $id);
		//return $this->render('OPTodoAppBundle:TodoApp:index.html.twig', array('form'=>$form->createView(), 'id'=>$id ));
	}	

}
