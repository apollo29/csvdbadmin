ace.define('ace/mode/csvdb', ['require', 'exports', 'module' , 'ace/lib/oop', 'ace/mode/text', 'ace/tokenizer', 'ace/mode/csvdb_highlight_rules', 'ace/range'], function(require, exports, module) {

    var oop = require("../lib/oop");
    var TextMode = require("../mode/text").Mode;
    var Tokenizer = require("../tokenizer").Tokenizer;
    var CsvdbHighlightRules = require("./csvdb_highlight_rules").CsvdbHighlightRules;
    var Range = require("../range").Range;

    var Mode = function() {
        this.$tokenizer = new Tokenizer(new CsvdbHighlightRules().getRules());
    };
    oop.inherits(Mode, TextMode);

    (function() {
        this.lineCommentStart = "--";
        this.blockComment = {start: "/*", end: "*/"};

        this.getNextLineIndent = function(state, line, tab) {
            if(state == "start" || state == "keyword.statementEnd") {
                return "";
            } else {
                return this.$getIndent(line); // Keep whatever indent the previous line has
            }
        }

    }).call(Mode.prototype);

    exports.Mode = Mode;
});

ace.define('ace/mode/csvdb_highlight_rules', ['require', 'exports', 'module' , 'ace/lib/oop', 'ace/lib/lang', 'ace/mode/doc_comment_highlight_rules', 'ace/mode/text_highlight_rules', 'ace/mode/perl_highlight_rules', 'ace/mode/python_highlight_rules'], function(require, exports, module) {

    var oop = require("../lib/oop");
    var lang = require("../lib/lang");
    var DocCommentHighlightRules = require("./doc_comment_highlight_rules").DocCommentHighlightRules;
    var TextHighlightRules = require("./text_highlight_rules").TextHighlightRules;
    var PerlHighlightRules = require("./perl_highlight_rules").PerlHighlightRules;
    var PythonHighlightRules = require("./python_highlight_rules").PythonHighlightRules;

    var CsvdbHighlightRules = function() {
        var keywords = ( // http://dev.csvdb.com/doc/refman/5.6/en/reserved-words.html
            "and|asc|by|constraint|current_date|current_time|current_timestamp|default|delete|desc|false|from|in|index|insert|integer|into|is|like|limit|not|null|or|order|primary|select|set|table|to|true|unique|update|values|where"
        );


        var builtinFunctions = ( // http://dev.csvdb.com/doc/refman/5.6/en/func-op-summary-ref.html
            "count|current_date|current_time|current_timestamp|in|insert|isnull|last_insert_id|now"
        );

        var keywordMapper = this.createKeywordMapper({
            "support.function": builtinFunctions,
            "keyword": keywords
        }, "identifier", true);


        var sqlRules = [
            {
                token: "string", // single line string -- assume dollar strings if multi-line for now
                regex: "['](?:(?:\\\\.)|(?:[^'\\\\]))*?[']"
            },
            {
                token: "variable.language", // pg identifier
                regex: '".*?"'
            },
            {
                token: "constant.numeric", // float
                regex: "[+-]?\\d+(?:(?:\\.\\d*)?(?:[eE][+-]?\\d+)?)?\\b"
            },
            {
                token: keywordMapper,
                regex: "[a-zA-Z_][a-zA-Z0-9_$]*\\b" // TODO - Unicode in identifiers
            },
            {
                token: "keyword.operator",
                regex: "!|!!|!~|!~\\*|!~~|!~~\\*|#|##|#<|#<=|#<>|#=|#>|#>=|%|\\&|\\&\\&|\\&<|\\&<\\||\\&>|\\*|\\+|" +
                    "\\-|/|<|<#>|<\\->|<<|<<=|<<\\||<=|<>|<\\?>|<@|<\\^|=|>|>=|>>|>>=|>\\^|\\?#|\\?\\-|\\?\\-\\||" +
                    "\\?\\||\\?\\|\\||@|@\\-@|@>|@@|@@@|\\^|\\||\\|\\&>|\\|/|\\|>>|\\|\\||\\|\\|/|~|~\\*|~<=~|~<~|" +
                    "~=|~>=~|~>~|~~|~~\\*"
            },
            {
                token: "paren.lparen",
                regex: "[\\(]"
            },
            {
                token: "paren.rparen",
                regex: "[\\)]"
            },
            {
                token: "text",
                regex: "\\s+"
            }
        ];


        this.$rules = {
            "start": [
                {
                    token: "comment",
                    regex: "(--\\s+|#).*$" // http://dev.csvdb.com/doc/refman/5.6/en/comments.html
                },
                DocCommentHighlightRules.getStartRule("doc-start"),
                {
                    token: "comment", // multi-line comment
                    regex: "\\/\\*",
                    next: "comment"
                },
                {
                    token: "keyword.statementBegin",
                    regex: "^[a-zA-Z]+", // Could enumerate starting keywords but this allows things to work when new statements are added.
                    next: "statement"
                },
                {
                    token: "support.buildin", // psql directive
                    regex: "^\\\\[\\S]+.*$"
                }
            ],

            "statement": [
                {
                    token: "comment",
                    regex: "--.*$"
                },
                {
                    token: "comment", // multi-line comment
                    regex: "\\/\\*",
                    next: "commentStatement"
                },
                {
                    token: "statementEnd",
                    regex: ";",
                    next: "start"
                },
                {
                    token: "string", // perl, python, tcl are in the pg default dist (no tcl highlighter)
                    regex: "\\$perl\\$",
                    next: "perl-start"
                },
                {
                    token: "string",
                    regex: "\\$python\\$",
                    next: "python-start"
                },
                {
                    token: "string",
                    regex: "\\$[\\w_0-9]*\\$$", // dollar quote at the end of a line
                    next: "dollarSql"
                },
                {
                    token: "string",
                    regex: "\\$[\\w_0-9]*\\$",
                    next: "dollarStatementString"
                }
            ].concat(sqlRules),

            "dollarSql": [
                {
                    token: "comment",
                    regex: "--.*$"
                },
                {
                    token: "comment", // multi-line comment
                    regex: "\\/\\*",
                    next: "commentDollarSql"
                },
                {
                    token: "string", // end quoting with dollar at the start of a line
                    regex: "^\\$[\\w_0-9]*\\$",
                    next: "statement"
                },
                {
                    token: "string",
                    regex: "\\$[\\w_0-9]*\\$",
                    next: "dollarSqlString"
                }
            ].concat(sqlRules),

            "comment": [
                {
                    token: "comment", // closing comment
                    regex: ".*?\\*\\/",
                    next: "start"
                },
                {
                    token: "comment", // comment spanning whole line
                    regex: ".+"
                }
            ],

            "commentStatement": [
                {
                    token: "comment", // closing comment
                    regex: ".*?\\*\\/",
                    next: "statement"
                },
                {
                    token: "comment", // comment spanning whole line
                    regex: ".+"
                }
            ],

            "commentDollarSql": [
                {
                    token: "comment", // closing comment
                    regex: ".*?\\*\\/",
                    next: "dollarSql"
                },
                {
                    token: "comment", // comment spanning whole line
                    regex: ".+"
                }
            ],

            "dollarStatementString": [
                {
                    token: "string", // closing dollarstring
                    regex: ".*?\\$[\\w_0-9]*\\$",
                    next: "statement"
                },
                {
                    token: "string", // dollarstring spanning whole line
                    regex: ".+"
                }
            ],

            "dollarSqlString": [
                {
                    token: "string", // closing dollarstring
                    regex: ".*?\\$[\\w_0-9]*\\$",
                    next: "dollarSql"
                },
                {
                    token: "string", // dollarstring spanning whole line
                    regex: ".+"
                }
            ]
        };

        this.embedRules(DocCommentHighlightRules, "doc-", [ DocCommentHighlightRules.getEndRule("start") ]);
        this.embedRules(PerlHighlightRules, "perl-", [
            {token: "string", regex: "\\$perl\\$", next: "statement"}
        ]);
        this.embedRules(PythonHighlightRules, "python-", [
            {token: "string", regex: "\\$python\\$", next: "statement"}
        ]);
    };

    oop.inherits(CsvdbHighlightRules, TextHighlightRules);

    exports.CsvdbHighlightRules = CsvdbHighlightRules;
});

ace.define('ace/mode/doc_comment_highlight_rules', ['require', 'exports', 'module' , 'ace/lib/oop', 'ace/mode/text_highlight_rules'], function(require, exports, module) {


    var oop = require("../lib/oop");
    var TextHighlightRules = require("./text_highlight_rules").TextHighlightRules;

    var DocCommentHighlightRules = function() {

        this.$rules = {
            "start": [
                {
                    token: "comment.doc.tag",
                    regex: "@[\\w\\d_]+" // TODO: fix email addresses
                },
                {
                    token: "comment.doc.tag",
                    regex: "\\bTODO\\b"
                },
                {
                    defaultToken: "comment.doc"
                }
            ]
        };
    };

    oop.inherits(DocCommentHighlightRules, TextHighlightRules);

    DocCommentHighlightRules.getStartRule = function(start) {
        return {
            token: "comment.doc", // doc comment
            regex: "\\/\\*(?=\\*)",
            next: start
        };
    };

    DocCommentHighlightRules.getEndRule = function(start) {
        return {
            token: "comment.doc", // closing comment
            regex: "\\*\\/",
            next: start
        };
    };


    exports.DocCommentHighlightRules = DocCommentHighlightRules;

});

ace.define('ace/mode/perl_highlight_rules', ['require', 'exports', 'module' , 'ace/lib/oop', 'ace/mode/text_highlight_rules'], function(require, exports, module) {


    var oop = require("../lib/oop");
    var TextHighlightRules = require("./text_highlight_rules").TextHighlightRules;

    var PerlHighlightRules = function() {

        var keywords = (
            "base|constant|continue|else|elsif|for|foreach|format|goto|if|last|local|my|next|" +
            "no|package|parent|redo|require|scalar|sub|unless|until|while|use|vars"
        );

        var buildinConstants = ("ARGV|ENV|INC|SIG");

        var builtinFunctions = (
            "getprotobynumber|getprotobyname|getservbyname|gethostbyaddr|" +
            "gethostbyname|getservbyport|getnetbyaddr|getnetbyname|getsockname|" +
            "getpeername|setpriority|getprotoent|setprotoent|getpriority|" +
            "endprotoent|getservent|setservent|endservent|sethostent|socketpair|" +
            "getsockopt|gethostent|endhostent|setsockopt|setnetent|quotemeta|" +
            "localtime|prototype|getnetent|endnetent|rewinddir|wantarray|getpwuid|" +
            "closedir|getlogin|readlink|endgrent|getgrgid|getgrnam|shmwrite|" +
            "shutdown|readline|endpwent|setgrent|readpipe|formline|truncate|" +
            "dbmclose|syswrite|setpwent|getpwnam|getgrent|getpwent|ucfirst|sysread|" +
            "setpgrp|shmread|sysseek|sysopen|telldir|defined|opendir|connect|" +
            "lcfirst|getppid|binmode|syscall|sprintf|getpgrp|readdir|seekdir|" +
            "waitpid|reverse|unshift|symlink|dbmopen|semget|msgrcv|rename|listen|" +
            "chroot|msgsnd|shmctl|accept|unpack|exists|fileno|shmget|system|" +
            "unlink|printf|gmtime|msgctl|semctl|values|rindex|substr|splice|" +
            "length|msgget|select|socket|return|caller|delete|alarm|ioctl|index|" +
            "undef|lstat|times|srand|chown|fcntl|close|write|umask|rmdir|study|" +
            "sleep|chomp|untie|print|utime|mkdir|atan2|split|crypt|flock|chmod|" +
            "BEGIN|bless|chdir|semop|shift|reset|link|stat|chop|grep|fork|dump|" +
            "join|open|tell|pipe|exit|glob|warn|each|bind|sort|pack|eval|push|" +
            "keys|getc|kill|seek|sqrt|send|wait|rand|tied|read|time|exec|recv|" +
            "eof|chr|int|ord|exp|pos|pop|sin|log|abs|oct|hex|tie|cos|vec|END|ref|" +
            "map|die|uc|lc|do"
        );

        var keywordMapper = this.createKeywordMapper({
            "keyword": keywords,
            "constant.language": buildinConstants,
            "support.function": builtinFunctions
        }, "identifier");

        this.$rules = {
            "start": [
                {
                    token: "comment",
                    regex: "#.*$"
                },
                {
                    token: "comment.doc",
                    regex: "^=(?:begin|item)\\b",
                    next: "block_comment"
                },
                {
                    token: "string.regexp",
                    regex: "[/](?:(?:\\[(?:\\\\]|[^\\]])+\\])|(?:\\\\/|[^\\]/]))*[/]\\w*\\s*(?=[).,;]|$)"
                },
                {
                    token: "string", // single line
                    regex: '["](?:(?:\\\\.)|(?:[^"\\\\]))*?["]'
                },
                {
                    token: "string", // multi line string start
                    regex: '["].*\\\\$',
                    next: "qqstring"
                },
                {
                    token: "string", // single line
                    regex: "['](?:(?:\\\\.)|(?:[^'\\\\]))*?[']"
                },
                {
                    token: "string", // multi line string start
                    regex: "['].*\\\\$",
                    next: "qstring"
                },
                {
                    token: "constant.numeric", // hex
                    regex: "0x[0-9a-fA-F]+\\b"
                },
                {
                    token: "constant.numeric", // float
                    regex: "[+-]?\\d+(?:(?:\\.\\d*)?(?:[eE][+-]?\\d+)?)?\\b"
                },
                {
                    token: keywordMapper,
                    regex: "[a-zA-Z_$][a-zA-Z0-9_$]*\\b"
                },
                {
                    token: "keyword.operator",
                    regex: "\\.\\.\\.|\\|\\|=|>>=|<<=|<=>|&&=|=>|!~|\\^=|&=|\\|=|\\.=|x=|%=|\\/=|\\*=|\\-=|\\+=|=~|\\*\\*|\\-\\-|\\.\\.|\\|\\||&&|\\+\\+|\\->|!=|==|>=|<=|>>|<<|,|=|\\?\\:|\\^|\\||x|%|\\/|\\*|<|&|\\\\|~|!|>|\\.|\\-|\\+|\\-C|\\-b|\\-S|\\-u|\\-t|\\-p|\\-l|\\-d|\\-f|\\-g|\\-s|\\-z|\\-k|\\-e|\\-O|\\-T|\\-B|\\-M|\\-A|\\-X|\\-W|\\-c|\\-R|\\-o|\\-x|\\-w|\\-r|\\b(?:and|cmp|eq|ge|gt|le|lt|ne|not|or|xor)"
                },
                {
                    token: "lparen",
                    regex: "[[({]"
                },
                {
                    token: "rparen",
                    regex: "[\\])}]"
                },
                {
                    token: "text",
                    regex: "\\s+"
                }
            ],
            "qqstring": [
                {
                    token: "string",
                    regex: '(?:(?:\\\\.)|(?:[^"\\\\]))*?"',
                    next: "start"
                },
                {
                    token: "string",
                    regex: '.+'
                }
            ],
            "qstring": [
                {
                    token: "string",
                    regex: "(?:(?:\\\\.)|(?:[^'\\\\]))*?'",
                    next: "start"
                },
                {
                    token: "string",
                    regex: '.+'
                }
            ],
            "block_comment": [
                {
                    token: "comment.doc",
                    regex: "^=cut\\b",
                    next: "start"
                },
                {
                    defaultToken: "comment.doc"
                }
            ]
        };
    };

    oop.inherits(PerlHighlightRules, TextHighlightRules);

    exports.PerlHighlightRules = PerlHighlightRules;
});

ace.define('ace/mode/python_highlight_rules', ['require', 'exports', 'module' , 'ace/lib/oop', 'ace/mode/text_highlight_rules'], function(require, exports, module) {


    var oop = require("../lib/oop");
    var TextHighlightRules = require("./text_highlight_rules").TextHighlightRules;

    var PythonHighlightRules = function() {

        var keywords = (
            "and|as|assert|break|class|continue|def|del|elif|else|except|exec|" +
            "finally|for|from|global|if|import|in|is|lambda|not|or|pass|print|" +
            "raise|return|try|while|with|yield"
        );

        var builtinConstants = (
            "True|False|None|NotImplemented|Ellipsis|__debug__"
        );

        var builtinFunctions = (
            "abs|divmod|input|open|staticmethod|all|enumerate|int|ord|str|any|" +
            "eval|isinstance|pow|sum|basestring|execfile|issubclass|print|super|" +
            "binfile|iter|property|tuple|bool|filter|len|range|type|bytearray|" +
            "float|list|raw_input|unichr|callable|format|locals|reduce|unicode|" +
            "chr|frozenset|long|reload|vars|classmethod|getattr|map|repr|xrange|" +
            "cmp|globals|max|reversed|zip|compile|hasattr|memoryview|round|" +
            "__import__|complex|hash|min|set|apply|delattr|help|next|setattr|" +
            "buffer|dict|hex|object|slice|coerce|dir|id|oct|sorted|intern"
        );
        var keywordMapper = this.createKeywordMapper({
            "invalid.deprecated": "debugger",
            "support.function": builtinFunctions,
            "constant.language": builtinConstants,
            "keyword": keywords
        }, "identifier");

        var strPre = "(?:r|u|ur|R|U|UR|Ur|uR)?";

        var decimalInteger = "(?:(?:[1-9]\\d*)|(?:0))";
        var octInteger = "(?:0[oO]?[0-7]+)";
        var hexInteger = "(?:0[xX][\\dA-Fa-f]+)";
        var binInteger = "(?:0[bB][01]+)";
        var integer = "(?:" + decimalInteger + "|" + octInteger + "|" + hexInteger + "|" + binInteger + ")";

        var exponent = "(?:[eE][+-]?\\d+)";
        var fraction = "(?:\\.\\d+)";
        var intPart = "(?:\\d+)";
        var pointFloat = "(?:(?:" + intPart + "?" + fraction + ")|(?:" + intPart + "\\.))";
        var exponentFloat = "(?:(?:" + pointFloat + "|" + intPart + ")" + exponent + ")";
        var floatNumber = "(?:" + exponentFloat + "|" + pointFloat + ")";

        this.$rules = {
            "start": [
                {
                    token: "comment",
                    regex: "#.*$"
                },
                {
                    token: "string",           // """ string
                    regex: strPre + '"{3}(?:[^\\\\]|\\\\.)*?"{3}'
                },
                {
                    token: "string",           // multi line """ string start
                    regex: strPre + '"{3}.*$',
                    next: "qqstring"
                },
                {
                    token: "string",           // " string
                    regex: strPre + '"(?:[^\\\\]|\\\\.)*?"'
                },
                {
                    token: "string",           // ''' string
                    regex: strPre + "'{3}(?:[^\\\\]|\\\\.)*?'{3}"
                },
                {
                    token: "string",           // multi line ''' string start
                    regex: strPre + "'{3}.*$",
                    next: "qstring"
                },
                {
                    token: "string",           // ' string
                    regex: strPre + "'(?:[^\\\\]|\\\\.)*?'"
                },
                {
                    token: "constant.numeric", // imaginary
                    regex: "(?:" + floatNumber + "|\\d+)[jJ]\\b"
                },
                {
                    token: "constant.numeric", // float
                    regex: floatNumber
                },
                {
                    token: "constant.numeric", // long integer
                    regex: integer + "[lL]\\b"
                },
                {
                    token: "constant.numeric", // integer
                    regex: integer + "\\b"
                },
                {
                    token: keywordMapper,
                    regex: "[a-zA-Z_$][a-zA-Z0-9_$]*\\b"
                },
                {
                    token: "keyword.operator",
                    regex: "\\+|\\-|\\*|\\*\\*|\\/|\\/\\/|%|<<|>>|&|\\||\\^|~|<|>|<=|=>|==|!=|<>|="
                },
                {
                    token: "paren.lparen",
                    regex: "[\\[\\(\\{]"
                },
                {
                    token: "paren.rparen",
                    regex: "[\\]\\)\\}]"
                },
                {
                    token: "text",
                    regex: "\\s+"
                }
            ],
            "qqstring": [
                {
                    token: "string", // multi line """ string end
                    regex: '(?:[^\\\\]|\\\\.)*?"{3}',
                    next: "start"
                },
                {
                    token: "string",
                    regex: '.+'
                }
            ],
            "qstring": [
                {
                    token: "string",  // multi line ''' string end
                    regex: "(?:[^\\\\]|\\\\.)*?'{3}",
                    next: "start"
                },
                {
                    token: "string",
                    regex: '.+'
                }
            ]
        };
    };

    oop.inherits(PythonHighlightRules, TextHighlightRules);

    exports.PythonHighlightRules = PythonHighlightRules;
});
