<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\AddProjects;
use App\Models\submit_invoices;
use App\Models\add_on;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Users;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Http\Request;
// use App\Models\SubmitInvoice;

class HomeController  extends Controller
{
//    public function showLoginForm()
//    {
//        return view('login');
//    }
//    public function validateLogin(Request $request)
//    {
//        $email = $request->input('email');
//        $password = $request->input('password');
   
//        // Implement your custom logic to check user credentials
//       //  $users = users::where('email', $email)->first();
//        $users = Users::where('email', $email)->first();
// // dd($password ===$users->password);
   
//   if($users && password_verify($password, $users->password)) {
//       //  dd('hlw');
//         return redirect('dashboard')->with('success', 'Login successful!');
//     }

//     // If login fails, return with an error message
//     return redirect()->route('loginpage')->with('error', 'Invalid email or password');
//    }
//    public function logout(Request $request)

// {

//    $this->guard()->logout();

   

//    $request->session()->flush();


//    $request->session()->regenerate();



//    return redirect('/login');

// }
   public function dashboard()
   {
      return view('dashboard');
   }

   public function manage_project()
   {
      $projects = AddProjects::all();

      foreach ($projects as $value) {
         $total = 0;
         $invoices = submit_invoices::where('project_id', $value->id)->get();
         //   dd($invoices);
         foreach ($invoices as $invoice) {
            $total += $invoice->Total;
            $status = $invoice->status;
         }
         $value['total_invoice'] = $total;

         if ($status == 1) {
            $amount_received = submit_invoices::where('project_id', $value->id)->where('status', 1)->sum('total');

            $value['receviced_Amount'] = $amount_received;
            $value['remaining_Amount'] = $value->ProjectBudget - $amount_received;
         } else {
            $value['remaining_Amount'] = $value->ProjectBudget;
         }
      }

      return view("manage-project", ['users' => $projects]);
   }

   public function show($id)
   {
      $project = AddProjects::find($id);

      $invoices = submit_invoices::where('project_id', $id)->get();

      $invoice_Raised = 0;

      foreach ($invoices as $invoice) {
         $invoice_Raised += $invoice->Total;
      }


      $totalProjectBudget = $project->ProjectBudget;
      $remainingAmount = $totalProjectBudget - $invoice_Raised;
      // dd($invoice_Raised);
      // $data = ['projectData' => $project, 'invoicesData' => $invoices,  'invoice_Raised' => $invoice_Raised, 'remainingAmount' => $remainingAmount];

      return view('project-invoices', ['projectData' => $project, 'invoicesData' => $invoices,  'invoice_Raised' => $invoice_Raised, 'remainingAmount' => $remainingAmount]);
   }



   public function updateStatus(Request $request, submit_invoices $invoice)
   {
      $newStatus = $request->input('status');
      $invoice->update(['status' => $newStatus]);

      return redirect()->back();
   }


   public function add_projects()
   {
      return view('add-project');
   }
   public function manageProject(Request $request)
   {
      $AddProjectsDetails = [
         'ProjectCompany' => $request->input('projectcompany'),
         'ProjectName' => $request->input('projectname'),
         'ProjectBudget' => $request->input('projectbudget'),
         'ProjectType' => $request->input('projecttype'),
         'ProjectManager' => $request->input('projectmanager'),
         'Csm' => $request->input('csm'),
         'Contract' => $request->input('contract'),
         'Tags' => $request->input('tags'),
         'Milestone' => $request->input('milestone'),
         'Address' => $request->input('address'),
         'Comments' => $request->input('Comments'),

         'timezone_offset' => $request->input('timezone_offset'),
         'cilentname' => $request->input('cilentname'),
         'cilentemail' => $request->input('cilentemail'),
         'companyname' => $request->input('companyname'),
         'cilentphone' => $request->input('cilentphone'),
         'projectstartdate' => $request->input('projectstartdate'),
         'status' => $request->input('status'),

      ];
      // dd($AddProjectsDetails);




      AddProjects::create($AddProjectsDetails);
      return redirect()->back()->with('status', 'Projects Added Successfully');
   }

   public function addinvoices($id)
   {
      $projectData = AddProjects::find($id);
      // $projectData = $project->toArray();

      return view('add-invoice', ['projectData' => $projectData]);
   }
   public function submit_invoice(Request $request)
   {

      $submitinvoice = [

         'project_id' => $request->input('project_id'),


         'Bill_Genrate_Date' => $request->input('date'),

         'Date' => $request->input('date'),
         'DueDate' => $request->input('due_date'),
         'Description' => $request->input('Description'),
         'Quantity' => $request->input('Quantity'),
         'Price' => $request->input('Price'),
         'Amount' => $request->input('Amount'),
         'Total' => $request->input('Total'),
         'Comments' => $request->input('Comments'),
         'PaymentOption' => $request->input('flexRadioDefault'),
         'status' => 0,
      ];
      // dd($submitinvoice);
      DB::table('submit_invoices')->insert($submitinvoice);
      dd('raj');

      return redirect()->back()->with('status', 'Projects Added Successfully');
   }

   public function add_on(Request $request)
   {

      $add_onDetails = [
         'Name' => $request->input('Name'),
         'Description' => $request->input('Description'),
         'Price' => $request->input('Price'),
         'project_id' => $request->input('project_id'),

      ];

      //  DB::table('add_on')->insert($add_onDetails);
      $add_on =   add_on::create($add_onDetails);

      //  
      $project_id = $add_onDetails['project_id'];
      $project_Details = AddProjects::find($project_id);

      if ($project_Details) {
         $new_price = $project_Details->ProjectBudget + $add_onDetails['Price'];
         $project_Details->update(['ProjectBudget' => $new_price]);
      }

      return redirect()->back()->with('status', 'Add On Added Successfully');
   }
   public function Salesmanager(){
      return view('SalesManager');
   }
   public function add_Salesmanager(){
      return view('add_salesmanager');
   }
   public function validatSalesmanager(Request $request){
      $AddSalesDetails = [
         'name' => $request->input('Name'),
         'email' => $request->input('Email'),
         'password' => $request->input('Password'),
        
      ];
         dd($AddSalesDetails);
   }
}
