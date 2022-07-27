<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contact;

class Contacts extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $number, $email, $organization, $charge;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.contacts.view', [
            'contacts' => Contact::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('number', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->orWhere('organization', 'LIKE', $keyWord)
						->orWhere('charge', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->name = null;
		$this->number = null;
		$this->email = null;
		$this->organization = null;
		$this->charge = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'number' => 'required',
		'email' => 'required',
		'organization' => 'required',
		'charge' => 'required',
        ]);

        Contact::create([ 
			'name' => $this-> name,
			'number' => $this-> number,
			'email' => $this-> email,
			'organization' => $this-> organization,
			'charge' => $this-> charge
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Contact Successfully created.');
    }

    public function edit($id)
    {
        $record = Contact::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->number = $record-> number;
		$this->email = $record-> email;
		$this->organization = $record-> organization;
		$this->charge = $record-> charge;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'number' => 'required',
		'email' => 'required',
		'organization' => 'required',
		'charge' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Contact::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'number' => $this-> number,
			'email' => $this-> email,
			'organization' => $this-> organization,
			'charge' => $this-> charge
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Contact Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Contact::where('id', $id);
            $record->delete();
        }
    }
}
