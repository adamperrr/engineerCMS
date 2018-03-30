<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Subpage;
use App\Http\Requests\SubpageRequest;

use App\RenanBr\BibTexParser\Listener;
use App\RenanBr\BibTexParser\Parser;

use App\RenanBr\BibTexParser\Exception\ExceptionInterface;
use App\RenanBr\BibTexParser\Exception\ParserException;
use App\RenanBr\BibTexParser\Exception\ProcessorException;

use App\RenanBr\BibTexParser\Processor\KeywordsProcessor;
use App\RenanBr\BibTexParser\Processor\LatexToUnicodeProcessor;
use App\RenanBr\BibTexParser\Processor\NamesProcessor;
use App\RenanBr\BibTexParser\Processor\TagNameCaseProcessor;

class SubpagesAdminController extends Controller
{
    public function __construct()
    {
        Controller::__construct();
        $this->middleware(['auth', 'checkAdmin']);
    }

    public function create($page)
    {
        return view('subpages-admin.create', [
            'page' => $page
        ]);
    }

    public function store(SubpageRequest $request, Page $page)
    {
        $subpage = new Subpage();
        $subpage->title = $request->title;
        $subpage->titleVisibility = $request->titleVisibility == null ? 0 : 1;
        $subpage->description = $request->description;
        $subpage->descVisibility = $request->descVisibility == null ? 0 : 1;
        $subpage->type = $request->type;
        $subpage->content = $request->content;
        $subpage->order = 0;
        $subpage->page_id = $page->id;

        $subpage->save();
        return redirect()->route('pages-admin.index');
    }

    public function getBibtexFilesList(){
        $bibtexFilesList = \App\File::where('extension','bib')->get();
        $resultBibtexArr = [];

        foreach ($bibtexFilesList as $bibtexFile)
        {
            $resultBibtexArr[] = [
                'id' => $bibtexFile->id,
                'name' => $bibtexFile->name,
            ];
        }

        $response = [
            'status' => 'success',
            'data' => $resultBibtexArr,
        ];

        return response()->json($response);
    }

    public function test()
    {
        $fileId = 57;

        $file = \App\File::where('id',$fileId)->first();
        $filePath = public_path($file->url);

        $parser = new Parser();
        $listener = new Listener();
        $listener->addProcessor(new TagNameCaseProcessor(CASE_LOWER));
        // $listener->addProcessor(new NamesProcessor());
        // $listener->addProcessor(new LatexToUnicodeProcessor());
        $parser->addListener($listener);

        $parser->parseFile($filePath);
        $entries = $listener->export();
        $entries = $this->changeSpecialCharacters($entries);

        dd($entries);
    }

    public function getBibtexContentFromFile(Request $request)
    {
        $fileId = json_decode($request->bibtexId);

        $file = \App\File::where('id',$fileId)->first();
        $filePath = public_path($file->url);

        $parser = new Parser();
        $listener = new Listener();
        $listener->addProcessor(new TagNameCaseProcessor(CASE_LOWER));
        // $listener->addProcessor(new NamesProcessor());
        // $listener->addProcessor(new LatexToUnicodeProcessor());
        $parser->addListener($listener);

        $response = null;
        try {

            $parser->parseFile($filePath);

            $entries = $listener->export();
            $entries = $this->changeSpecialCharacters($entries);

            $response = [
                'status' => 'success',
                'data' => $entries,
            ];
        }
        catch (\Exception $exc) {
            $response = [
                'status' => 'error',
                'data' => $exc->getMessage(),
            ];
        }
        finally {
            return response()->json($response);
        }
    }

    public function getSubpagesByPageId(Request $request)
    {
        $pageId = json_decode($request->pageId);
        $subpages = Subpage::where('page_id', $pageId)->select('id', 'title')->get();

        $response = [
            'status' => 'success',
            'data' => $subpages,
        ];

        return response()->json($response);
    }

    public function edit(Subpage $subpage)
    {
        return view('subpages-admin.edit', [
            'subpage' => $subpage
        ]);
    }

    public function update(SubpageRequest $request, Subpage $subpage)
    {
        $subpage->title = $request->title;
        $subpage->titleVisibility = $request->titleVisibility == null ? 0 : 1;
        $subpage->description = $request->description;
        $subpage->descVisibility = $request->descVisibility == null ? 0 : 1;
        $subpage->type = $request->type;
        $subpage->content = $request->content;
        $subpage->save();

        return redirect()->route('pages-admin.index');
    }

    public function destroy(Subpage $subpage)
    {
        $subpage->delete();
        return redirect()->route('pages-admin.index');
    }

    public function updateOrder(Request $request)
    {
        $subpagesID = json_decode($request->subpagesID);
        $subpages = \App\Subpage::find($subpagesID);
        $flippedSubpagesID = array_flip($subpagesID); // Exchanges all keys with their associated values in an array

        foreach($subpages as $key => $subpage)
        {
            $subpage->order = $flippedSubpagesID[$subpage->id];
            $subpage->save();
        }

        $response = [
            'status' => 'success',
            'msg' => "Subpages order updated",
        ];

        return response()->json($response);
    }

    private function changeSpecialCharacters($bibtexArray)
    {
        $array_from_to = [
            '\\{' => '{',

            '\\k{a}' => 'ą', '\\k{A}' => 'Ą',
            '\\\'{c}' => 'ć', '\\\'{C}' => 'Ć',
            '\\k{e}' => 'ę', '\\k{E}' => 'Ę',
            '\\l{}' => 'ł', '\\L{}' => 'Ł',
            '\\\'{n}' => 'ń', '\\\'{N}' => 'Ń',
            '\\\'{o}' => 'ó', '\\\'{O}' => 'Ó',
            '\\\'{s}' => 'ś', '\\\'{S}' => 'Ś',
            '\\\'{z}' => 'ź', '\\\'{Z}' => 'Ź',
            '\\.{z}' => 'ź', '\\.{Z}' => 'Ź',

            '{\\"a}' => 'ä', '{\\"A}' => 'Ä', '\\"{a}' => 'ä', '\\"{A}' => 'Ä',
            '{\\"e}' => 'ë', '{\\"E}' => 'Ë', '\\"{e}' => 'ë', '\\"{E}' => 'Ë',
            '{\\"o}' => 'ö', '{\\"O}' => 'Ö', '\\"{o}' => 'ö', '\\"{O}' => 'Ö',
            '{\\"u}' => 'ü', '{\\"U}' => 'Ü', '\\"{u}' => 'ü', '\\"{U}' => 'Ü',
            '{\\ss}' => 'ß', '\\ss' => 'ß',

            '\\{ae}' => '&aelig;', '{\\ae}' => '&aelig;', '{\\{ae}}' => '&aelig;', '\\ae' => '&aelig;'
        ];

        foreach($bibtexArray as $key1 => $element)
        {
            foreach($element as $key2 => $field)
            {
                $bibtexArray[$key1][$key2] = str_replace(array_keys($array_from_to), $array_from_to, $field);
            }
        }
        return $bibtexArray;
    }
}
