namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
