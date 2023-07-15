

@if ($paginator->hasPages())
    <tr bgcolor="#BEBEBE">
      <td colspan="20">
       
        @if ($paginator->onFirstPage())
            <a href="#" class="disabled" style="color:#000"><span>← Previous</span></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a>
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <a href="#" class="disabled" style="color:#000"><span>{{ $element }}</span></li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active my-active"><span>{{ $page }}</span></a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a>
        @else
            <a href="#" class="disabled" style="color:#000"><span>Next →</span>
        @endif
    </td>
  </tr>
@endif 
