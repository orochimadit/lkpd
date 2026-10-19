<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningProgress;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    protected array $questions = [
        1 => [
            'id' => 1,
            'question' => 'Apa tujuan utama dari sebuah iklan yang ditujukan kepada masyarakat?',
            'options' => [
                'A' => 'Menceritakan dongeng masa lalu agar pembaca terhibur',
                'B' => 'Menarik perhatian dan membujuk orang agar tertarik membeli atau menggunakan produk/jasa',
                'C' => 'Memberikan laporan keuangan rahasia perusahaan',
                'D' => 'Menghafal nama-nama benda di sekitar kita',
            ],
            'correct' => 'B',
            'explanation' => 'Tepat sekali! Fungsi utama iklan adalah bersifat persuasif (mengajak, menarik perhatian, dan membujuk).',
        ],
        2 => [
            'id' => 2,
            'question' => 'Manakah di bawah ini yang merupakan kalimat FAKTA dalam sebuah iklan minuman lidah buaya khas Pontianak?',
            'options' => [
                'A' => '"Minuman ini adalah minuman paling lezat di seluruh dunia!"',
                'B' => '"Dijamin semua orang pasti jatuh cinta pada tegukan pertama!"',
                'C' => '"Mengandung 100% serat alami lidah buaya hasil panen petani Siantan."',
                'D' => '"Rasanya tiada tanding dan membuatmu langsung pintar."',
            ],
            'correct' => 'C',
            'explanation' => 'Benar! Kalimat C merupakan fakta karena dapat dibuktikan kebenarannya secara nyata (kandungan bahan dan lokasi panen), sedangkan pilihan lain adalah opini/klaim pujian.',
        ],
        3 => [
            'id' => 3,
            'question' => 'Di antara kalimat berikut, manakah yang merupakan kalimat OPINI yang sering digunakan dalam bahasa iklan?',
            'options' => [
                'A' => 'Toko buka setiap hari Senin sampai Sabtu pukul 08.00 - 17.00 WIB.',
                'B' => 'Produk ini telah memiliki sertifikasi halal dari BPJPH.',
                'C' => 'Kain tenun corak insang nomor satu dengan motif paling indah se-Kalimantan Barat.',
                'D' => 'Tersedia dalam ukuran botol 250 ml dan 500 ml.',
            ],
            'correct' => 'C',
            'explanation' => 'Hebat! Kata "nomor satu" dan "paling indah" merupakan penilaian subjektif (opini) yang bertujuan menarik minat konsumen.',
        ],
        4 => [
            'id' => 4,
            'question' => 'Unsur apa saja yang wajib ada dalam sebuah iklan media cetak agar pembaca mudah memahaminya?',
            'options' => [
                'A' => 'Judul yang menarik, nama produk, gambar/ilustrasi jelas, dan kalimat ajakan yang komunikatif.',
                'B' => 'Hanya boleh ada tulisan panjang tanpa gambar sama sekali.',
                'C' => 'Hanya berisi harga barang tanpa ada nama produknya.',
                'D' => 'Nama pemilik toko tanpa keterangan produk yang dijual.',
            ],
            'correct' => 'A',
            'explanation' => 'Benar! Iklan yang baik memadukan judul mencolok, gambar menarik, nama produk, serta ajakan yang jelas.',
        ],
        5 => [
            'id' => 5,
            'question' => 'Mengapa mengangkat produk kearifan lokal Pontianak (seperti Aloe Vera atau Bingke) dalam iklan sangat bermanfaat?',
            'options' => [
                'A' => 'Agar kita tidak perlu membuat ide baru',
                'B' => 'Untuk melestarikan dan mempromosikan potensi daerah agar dikenal luas dengan bangga',
                'C' => 'Supaya harga produk menjadi sangat mahal',
                'D' => 'Karena produk lokal tidak boleh diiklankan di media sosial',
            ],
            'correct' => 'B',
            'explanation' => 'Tepat sekali! Mempromosikan produk lokal Pontianak membangun rasa cinta tanah air dan membantu kemajuan ekonomi daerah kita.',
        ],
    ];

    public function index()
    {
        $user = Auth::user();
        $latestAttempt = QuizAttempt::where('user_id', $user->id)->latest()->first();

        return view('student.quiz.index', [
            'questions' => $this->questions,
            'latestAttempt' => $latestAttempt,
        ]);
    }

    public function submit(Request $request)
    {
        $answers = $request->input('answers', []);
        $correctCount = 0;
        $details = [];

        foreach ($this->questions as $id => $q) {
            $userAns = $answers[$id] ?? null;
            $isCorrect = ($userAns === $q['correct']);
            if ($isCorrect) {
                $correctCount++;
            }
            $details[$id] = [
                'user_answer' => $userAns,
                'correct_answer' => $q['correct'],
                'is_correct' => $isCorrect,
                'explanation' => $q['explanation'],
            ];
        }

        $totalQuestions = count($this->questions);
        $score = round(($correctCount / $totalQuestions) * 100);

        $user = Auth::user();
        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'correct_count' => $correctCount,
            'answers_json' => $details,
        ]);

        LearningProgress::updateOrCreate(
            ['user_id' => $user->id, 'module_slug' => 'kuis-tantangan'],
            ['is_completed' => true, 'completed_at' => now()]
        );

        return redirect()->route('student.quiz.index')->with([
            'quiz_result' => true,
            'score' => $score,
            'correctCount' => $correctCount,
            'totalQuestions' => $totalQuestions,
            'details' => $details,
        ]);
    }
}
