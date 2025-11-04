from collections import namedtuple

Task = namedtuple('Task',['summary','owner','done','id'])
Task.__new__.__defaults__ = (None,None,False,None)

def test_defaults():

   t1 = Task()
   t2 = Task(None, None, False, None)
   assert t1 == t2

def test_member_access():
   t = Task('buy milk', 'brian')
   assert t.summary == 'buy milk'
   assert t.owner == 'brian'
   assert (t.done,t.id) == (False,None)



def test_replace():


    task = Task('finish book', 'brian', False)

    # your code
    task = task._replace(id= 10, done= True)
    expected = Task('finish book', 'brian', True, 10)
    assert task == expected