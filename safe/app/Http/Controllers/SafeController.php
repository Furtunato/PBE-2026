<?php

namespace App\Http\Controllers;

use App\Models\Autorizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SafeController extends Controller
{
    // Admin - Dashboard com formulário e lista
    public function index()
    {
        // 1. Lista de todas as autorizações para a tabela
        $autorizacoes = Autorizacao::orderBy('created_at', 'desc')->get();

        // 2. Métrica: Aguardando o Professor aprovar
        $arquivos_pendentes_prof = Autorizacao::where('status_aqv', 'aprovado')
            ->where('status_professor', 'pendente')
            ->count();

        // 3. Métrica: Liberado pelo professor, mas parado na Portaria
        $arquivos_pendentes_port = Autorizacao::where('status_professor', 'aprovado')
            ->where('status_portaria', 'pendente')
            ->count();

        // 4. Métrica: Fluxos concluídos (liberados na portaria) HOJE
        $total_concluido = Autorizacao::where('status_portaria', 'liberado')
            ->whereDate('updated_at', Carbon::today())
            ->count();

        // 5. Métrica: Alunos em trânsito (Liberados da sala de aula, a caminho da portaria)
        $alunos_transito = Autorizacao::where('status_professor', 'aprovado')
            ->where('status_portaria', 'pendente')
            ->count();

        return view('safe.index', compact(
            'autorizacoes', 
            'arquivos_pendentes_prof', 
            'arquivos_pendentes_port', 
            'total_concluido', 
            'alunos_transito'
        ));
    }
    
    // Professor - Apenas solicitações com AQV aprovado
    public function professor()
    {
        $autorizacoes = Autorizacao::where('status_aqv', 'aprovado')
            ->where('status_professor', 'pendente')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('safe.professor', compact('autorizacoes'));
    }
    
    // Portaria - Apenas solicitações com professor aprovado
    public function portaria()
    {
        $autorizacoes = Autorizacao::where('status_professor', 'aprovado')
            ->where('status_portaria', 'pendente')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('safe.portaria', compact('autorizacoes'));
    }
    
    // Admin cria autorização (já com AQV aprovado)
    public function store(Request $request)
    {
        $request->validate([
            'aluno_nome' => 'required|string|max:255',
            'turma' => 'required|string|max:50',
            'professor_nome' => 'required|string|max:255',
            'responsavel_nome' => 'required|string|max:255',
            'responsavel_email' => 'required|email',
            'tipo_fluxo' => 'required|string',
            'horario' => 'required',
            'data_evento' => 'required|date',
            'controle_falta' => 'required|string',
            'aula_referencia' => 'required|string',
            'quem_autorizou' => 'required|string|max:255',
        ]);
        
        // Admin já cria com status_aqv = aprovado
        $data = $request->all();
        $data['status_aqv'] = 'aprovado';
        
        $autorizacao = Autorizacao::create($data);
        
        Log::info('📧 AUTORIZAÇÃO CRIADA PELO ADMIN: ' . $autorizacao->aluno_nome);
        
        return redirect()->back()->with('success', 'Autorização criada! Aluno aguarda liberação do professor.');
    }
    
    // Aprovar etapas (professor e portaria)
    public function aprovar(Autorizacao $autorizacao, $etapa)
    {
        if ($etapa === 'professor') {
            $autorizacao->update(['status_professor' => 'aprovado']);
            Log::info('✅ Professor liberou: ' . $autorizacao->aluno_nome);
            return redirect('/professor')->with('success', 'Aluno liberado da sala!');
        }
        
        if ($etapa === 'portaria') {
            $autorizacao->update(['status_portaria' => 'liberado']);
            Log::info('✅ Portaria liberou: ' . $autorizacao->aluno_nome);
            return redirect('/portaria')->with('success', 'Catraca liberada! Acesso autorizado.');
        }
        
        return redirect('/');
    }
}