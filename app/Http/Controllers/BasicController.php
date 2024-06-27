<?php

namespace App\Http\Controllers;

/**
 * Singer data structure.
 *
 * @typedef {Object} SingerData
 * @property {string} name - The singer's name.
 * @property {Array<SongData>} songs - An array of songs the singer performed.
 */

/**
 * @typedef {Object} SongData
 * @property {string} song - The name of the song the singer performed.
 * @property {Array<JudgeScore>} scores - An array of scores given by the judges.
 * @property {number} total_score - The total score of the song the singer received from the judges.
 */

/**
 * @typedef {Object} JudgeScore
 * @property {string} judge - The name of the judge who gave the score.
 * @property {Array<ScoreItem>} data - An array of scores for individual performance items.
 * @property {number} final_score - The final score of the singer given by the judge.
 */

/**
 * @typedef {Object} ScoreItem
 * @property {string} item - The name of the performance item being scored, for definition see SCORE_ITEMS.
 * @property {number} score - The score given for the specific item.
 */

/**
 * Singer data structure.
 *
 * @typedef {Object} SingerData
 * @property {string} name - The singer's name.
 * @property {Array<SongData>} songs - An array of songs the singer performed.
 */

abstract class BasicController
{
    const KEY_CURRENT_SINGER = 'current_singer';
    const KEY_SINGERS = 'singers';
    const PREFIX_SINGER = 'singer_';
    const KEY_CURRENT_SONG = 'current_song';
    const KEY_SONGS = 'songs';
    const PREFIX_SONG = 'song_';
    const KEY_TEAMS = 'teams';
    const PREFIX_TEAM = 'team_';
    const SCORE_ITEMS = [
        'A' => 0.3, // 音准
        'B' => 0.2, // 音色
        'D' => 0.2, // 节奏
        'C' => 0.2, // 情感|个人表现
        'E' => 0.1, // 评委主观分
    ];

    // takes and returns a SongData object
    function calculateTotalScore(array $song_data): array
    {
        $final_score = 0;
        $scores = [];
        foreach ($song_data['scores'] as $score) {
            $total_score = 0;
            foreach ($score['data'] as $item) {
                if (isset(self::SCORE_ITEMS[$item['item']])) {
                    $total_score += $item['score'] * self::SCORE_ITEMS[$item['item']];
                } else {
                    return $song_data;
                }
            }
            $score['total_score'] = round($total_score, 2);
            $scores[] = $score;
            $final_score += $total_score;
        }
        $song_data['scores'] = $scores;
        $song_data['final_score'] = round($final_score / count($song_data['scores']), 2);
        return $song_data;
    }
}
