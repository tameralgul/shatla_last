class PaidController extends Controller
{
  public function index(Request $request)
    {
        return 
        "order: ".$request->reference->order."<br>".
        "status: ".$request->status."<br>".
        "amount: ".$request->amount."<br>";
    }
}
